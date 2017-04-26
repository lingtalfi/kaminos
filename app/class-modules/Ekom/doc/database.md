Database
==================
2017-04-26




Nomenclature/general notes
================

A store represents a physical store, while a shop represents a virtual store.

In general, we try to use the snake_case rather than the camelCase.

Some tables contain columns that need to be translated.

Generally when there is only one column to be translated, we add a lang_id column
into the table.

When there is more than one column, we generally create a dedicated table for holding those 
translations (thus isolating the translations in the new table),
and the name of the new table generally becomes the name of the original table, with the _lang suffix appended.

This technique saves us from duplicating a whole line while translating only a few columns (which wastes
db space).

A very important concept to understand is the difference between product and product_reference.

If you can picture that a product can come in many variations, for instance on a color attribute
(one variation of the product is yellow, while another is green, etc).

Then, the product is the base product on which those attributes are attached.
A product can have multiple attribute variations, like for instance a chair, which can come 
in different colors, but also different sizes.

For each possible variation, there is only one reference,
which serves the purpose of uniquely identifying a product in a certain state/configuration of
attributes, so that we can put a price on that reference, amongst other things.

Both product and product references are necessary and work together.

On the fron, we display a list of products, but when we buy something, we always
know the exact reference of the product we are buying.


Otherwise specified, foreign keys "on update" and "on set" are set to CASCADE.


Lang
-----------

All items of the database can be translated.
Lang is used to identify/translate those items in the database.

Each shop has its own lang (defined in shop_configuration), which affects front office strings.

The backoffice language depends on the backoffice_user's preferences.



- label
- iso_code: a 639-3 iso code
                    http://www-01.sil.org/iso639-3/codes.asp


Note: the flag image should be guessed from the iso code.


Backoffice_user
--------------------

- email: we might need to alert that user, hence the email instead of a simple login
- pass
- lang_id: the default lang_id of the backoffice for this user
- role_profile_id: indicates which profile the user has



Role_profile
---------------

- label

Role_badge
---------------

- label


Role_group
---------------

- label
- role_group_id: int|null


Role_group_has_badge
---------------

Role_profile_has_badge
---------------

Role_profile_has_group
---------------





Shop
-----------

This represents a virtual store.

- label: a label to identify the store in the backoffice (not displayed in front)
- lang_id: the default lang used for this shop,
            The "on update" and "on set" values are set to "SET NULL".
            So, if the lang disappear, the shop stays, and the value of lang_id becomes null.



Shop_has_store
-----------

Store
-----------





User
---------

- email: the user's email, used as a login
- pass: the user's password
- base_shop_id: the id of the shop where the user was registered in the first place.
                With this information, we can for instance decide later whether or not an user
                can connect just the base shop, or all our shops.
                Note that this is NOT a foreign key.
- date_creation: the datetime representing WHEN the account was created
- main_address_id: null|int, the id of the main/default address of the user, or null if no user is created yet.

- mobile
- phone

- active: int(0|1), default=0, whether or not the user is active.
                    If the user is not active, she cannot connect to her account.
                    When the user creates an account via the front, the default becomes 1.
                    
                    
- pro: int(0|1), whether or not the user is a pro or a regular customer.
                This field needs to be added by an Ekom plugin (i.e. it is not part
                of the default Ekom plugin).



Address
-----------------

- type: string(billing|shipping)
- country_id
- state_id: int|null, Note: not all countries might use states, just put an empty string there if this is the case
- city
- postcode: varchar  (some postcodes contain letters)
- address 
- active: int(0|1)





Country
--------------
- iso_code: ISO 3166-1 alpha2 code
            https://en.wikipedia.org/wiki/ISO_3166-1



Country_lang
--------------
- label
- country_id
- lang_id



State
--------------

Note that we don't translate states, using occidental alphabet, 
since those names are very specific.


- iso_code: ISO 3166-2 code
            https://en.wikipedia.org/wiki/List_of_administrative_divisions_by_country
- label
- country_id



Cart
--------------

The cart is generally stored in the php session as the user shops.
However, it is also saved to the database, so that when an user disconnects and reconnects later,
she doesn't lost her cart.

Upon user reconnection, the items in the session (if any) and the items in the database shall be merged.

In other words, the data in this table just serves the purpose of rebooting/re-launching the
user cart when the user reconnects after a while.

Note that this is not a table where you record the cart movement.


- user_id
- items: text, serialized version of all product_reference_id and qty in the user's cart 





Shop_has_product
-----------

This table let you create subsets of your catalogue for each shop.
Furthermore, you can also decide whether or not the product is active.


Product
--------------


- product_reference_id: "on update" and "on delete" are set to "SET NULL".
                    This designates the main product reference (the precise product variation)
                    that should be displayed as the "front" product (it would have precedence
                    over the other product variations).
                    
                    
                    


Product_has_product_attribute
--------------


Product_attribute
--------------

A product attribute is like a characteristic of a product.
For example: color could be an attribute of a t-shirt which comes in different colors.

Note: some products don't have attributes and that's perfectly fine.

Color, size, weight are common product attributes.

If a product uses attributes, every variation of this product has to use an attribute.
A default attribute can be created if necessary.


Product_attribute_value
--------------

A product attribute value is just a concrete value for a product attribute.
We store those values in the database so that we can search for them with the search engine for instance,
and also we can display them on the product page as possible items to select from.

And probably other places too.

Product_has_video
--------------
The video will be normally displayed on the product page.


Video
--------------

- uri


Product_reference
--------------

This table maps a natural reference to a business reference.

- weight: decimal(20,6)
- natural_reference: this is an automatically generated unique number, generated by ekom,
                    and based on the ids of the product, and all its attributes and attributes values
                    in a well defined order (i.e. predictable).
                    
- reference: the business reference


Note: there is no direct link between the product table and the product_reference table.
When we need the reference of a product (in a given state), we compute its natural reference,
and then look up its true reference in the product_reference table.



Product_reference_shop
--------------
This table contains reference related info for a given shop


Product_reference_store
--------------
This table contains reference related info for a given store.
Basically, the quantity remaining in the store.






Tax
-------
- reduction: reduction in percent

Tax_lang
-------

Tax_rule
-------
- condition:

The goal of this table is that a condition matches (or doesn't match);
and when it does, it means we should apply the tax bound to it.

The syntax of the condition should permit a lot of flexibility in how a tax is bound 
to a product.

We should be able to do things like this (using brainstorming pseudo syntax, just to give ideas
of what's possible):

- country.iso = fra
- product.type = physical (not virtual)
- ...




Product_has_tax_rule
-------


Category
-------

If a product is registered in a category,
it will be also displayed in all parent categories.













Resources
=============
Download prestashop languages:
http://doc.prestashop.com/display/PS16/Languages

