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


All tables name use singular form (not plural).




Condition -> action Paradigm
-----------------------------

The Condition-action paradigm is used to apply discounts (at both the product level, and/or the cart level),
and also to apply carrier business strategies.

It could be applied to other areas as well.

The idea is to modelize business models with the power of a few computer language constructs,
so that any idea can be implemented.

The condition interpretation is delegated to the application and plugins via hooks,
which make the model extensible.

First, define your conditions, like this for instance:

(if)
price > 20
& cart containsProduct 452
|| ( cart hasMinAmountOf 100 && cart hasMaxAmountOf 500 )
& ! user.country isEqualTo France


Then, define your actions:

(then)
applyDiscountToProduct 600 reductionPercent = 10





Tables
=============



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
The "on update" and "on set" values are set to "SET NULL" for all foreign keys of this table.

- label: a label to identify the store in the backoffice (not displayed in front)
- lang_id: the default lang used for this shop: is the default language on the front, and is also the back-office language for this shop
- currency_id: the currency used by default for this shop (default currency of the front, and currency of the back-office)
- timezone_id: the time zone used in this shop




Shop_configuration
----------------


This is an extension of the shop.
Basically, providing a dynamic structure for modules/plugins to hook in.


- key
- value: varchar(512) as for now, relying on author tricky mind to not override this limit




Shop_has_store
-----------

Store
-----------



Product_origin
-----------------

As we can read [here](https://www.prestashop.com/forums/topic/93918-multiple-manufacturers-for-a-single-product/),
at the semantic level, a product could come from any number of:


- manufacturer 
- supplier
- author
- ...?

The source table groups all those possibilities.


- type: manufacturer, supplier, author, ...
- value
- image





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

- user_group_id: 



User_group
---------
Just a way or organizing users.
You must have at least one group to put your users inside of.

Other plugins can create their own groups (for instance b2b, b2c, ...).



Address
-----------------

- type: string(billing|shipping)
- country_id
- state_id: int|null, Note: not all countries might use states, just put an empty string there if this is the case
- city
- postcode: varchar  (some postcodes contain letters)
- address 
- active: int(0|1|2), 2 means deleted. One shall not be able to recover from deleted.
                    A deleted entry stays in the table so that when the user
                    sees her orders, we can dynamically track back to the address information
                    simply using the address_id (which was not deleted).





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
                    
                    
                    

Product_lang
--------------

Per shop description and label.
By default, the description and label belongs to a product, not a reference.

However, if you want, you can override those labels and descriptions using the 
product_reference_shop_lang table.



Product_has_tag
--------------

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


Product_reference_shop_lang
------------------------------
In some cases, you might want to have control over the description or the label of the product at the
reference level (including attributes).

Set the label and description columns of this table to non null values will override 
the corresponding values from the product_lang table.

- label
- description




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




Currency
-------------

A currency available to the ekom system (back or front).

find rate: http://www.xe.com/currencyconverter/

- iso_code: iso code 4217
- symbol: the symbol representing the currency (for instance $)
- exchange_rate: decimal(20,6)


Currency_lang
-------------
- id_currency
- id_lang
- name


Currency_shop
-------------

You can activate/de-activate a currency per shop.

- active: tinyint(0|1)=0



Timezone
-----------
- name:




Condition
-----------
- type: custom string to specify/group conditions by affinity
- combinator: none|or|and: default=none
- negation: tinyint(0|1), whether to prefix the rest of the condition with the negation operator (!)
- start_group: tinyint(0|1), whether or not to start the rest of the condition with an opening parenthesis
- end_group: tinyint(0|1), whether or not to end the condition with a closing parenthesis
- left_operand:
- operator:
- right_operand:
- right_operand2:
- ...: might be more in the future


Action
-----------
- source
- source2
- operator:
- target:
- target2:
- ...: might be more in the future





Payment_method
--------------

- label
- lang_id: (translatable)


Payment_mode_shop
--------------

Select the set of payment methods available to your shop.

- active: 0|1


Order
-------

Is used to display orders to the user in the front.

When an order is placed, its data cannot change in the future (for obvious consistency reasons),
therefore it's good to have all data available in the order table.

Note: if the user wants to change her order, she can't. She might be able to duplicate an old order though (to implement
if necessary).

Think that we'll need to recreate a pdf invoice out of the data put in the order table.


Note that we need to flatten all data, be it a dynamic carrier strategy, or an user address.




- reference: reference created by ekom according to some format (which you can control)
- date: datetime
- tracking_number: null|string, provided by some carriers, but not all
- user_info: a serialized array containing the following info:
    - id (just in case), email, mobile, phone, pro (a plugin needs to put this field here), group label.
            
- shop_info: a serialized array containing the following:
    - id, label, currency_symbol, currency_code


- invoice_address_info: serialized array with the following:
    - invoice_country
    - invoice_state: 
    - invoice_city
    - invoice_postcode: varchar  (some postcodes contain letters)
    - invoice_address 


- billing_address_info: serialized array with the following:
    - billing_country
    - billing_state
    - billing_city
    - billing_postcode: varchar  (some postcodes contain letters)
    - billing_address 

- order_details: a serialized version of the ekom order model, as defined in the appendixes of this document




order_has_order_status
----------------

Status history.

- date: datetime


Order_status
----------------
Contains the statuses used by ekom.
States can be created by plugins and modules, or manually.
Some default states are provided by ekom.
    - https://support.bigcommerce.com/articles/Public/Understanding-Order-Statuses
    - Pending — customer started the checkout process, but did not complete it. 
    - Awaiting Payment — customer has completed checkout process, but payment has yet to be confirmed. Authorize only transactions that are not yet captured have this status.
    - Awaiting Fulfillment — customer has completed the checkout process and payment has been confirmed
    - Awaiting Shipment — order has been pulled and packaged, and is awaiting collection from a shipping provider
    - Awaiting Pickup — order has been pulled, and is awaiting customer pickup from a seller-specified location
    - Partially Shipped — only some items in the order have been shipped, due to some products being pre-order only or other reasons
    - Completed — order has been shipped/picked up, and receipt is confirmed; client has paid for their digital product and their file(s) are available for download
    - Shipped — order has been shipped, but receipt has not been confirmed; seller has used the Ship Items action. 
    - Cancelled — seller has cancelled an order, due to a stock inconsistency or other reasons. 
    - Declined — seller has marked the order as declined for lack of manual payment, or other reasons
    - Refunded — seller has used the Refund action.
    - Disputed — customer has initiated a dispute resolution process for the PayPal transaction that paid for the order
    - Verification Required — order on hold while some aspect (e.g. tax-exempt documentation) needs to be manually confirmed.
     Orders with this status must be updated manually. 
     Capturing funds or other order actions will not automatically update the status of an order marked Verification Required.     



- label
- lang_id

Order_status_shop
----------------
- color: web color 








Carrier
-------------
(could have been named carrier_method)


The goal of the carrier related tables is to implement specific carrier pricing strategies.
A pricing strategy might involve various factors, depending on the carrier service, for instance
the weight of the products, the shipping address, or the store address, or maybe just a flat rate, or anything
that one can think of.

What's common to all carrier strategies is that the end goal is to update a given order total (be it with
or without tax applied).

By update, I mean raising the given price by one of those techniques:

- fixed amount 
- percent


This is important because this technique is used to recreate users orders in the front, 
so we need to stamp it (know the implementation details is enough).



Can you imagine the case where one order leads to multiple carriers being involved? 
I can, if no carrier method provided by the shop is able to handle the delivery of all the products at once,
then (at the ekom level), the delivery might be split up into multiple deliveries.

In order to do that, a carrier should be able to answer the question:

- can you handle/deliver this product?


This can be done with the flexible condition-action system already in place.
We just need to have a "signalCannotHandle" type of action, and we also shall be able to give the reason why
the delivery is not possible (too heavy for instance).

That would force us to run a condition checking loop at the carrier selection page, but it would work.
We could/should create a separate carrierCheck type for condition.


So at the payment tunnel level, the idea would be to run the handleCarrier loop,
to assign carriers to products (with the help of the user input/choices of course),
then memorizing those in session,
and when the payment is done, flattening all data to the order table.  






Carrier_lang
-------------
- label:
- description


Carrier_shop
-------------
- active:

Carrier_has_condition
-------------

Carrier_has_action
-------------
About tax rules applied to shipping,
since each country has its own laws, as we can guess by reading this document: https://www.avalara.com/learn/whitepapers/shipping-handling-sales-tax/,

then the idea is that the carrier in ekom uses the flexible condition-action model
to both implement the carrier strategy (each zone has a different price, depending on weight, or price, or whatever),
AND the tax rules setting (depending on what you want, this carrier for this order will have the tax rule #452 for instance)
if any.

Note about conditions:
for france, we generally have one tax rule for the whole country,
so we can use an always true condition (like 1=1 for instance) to select the same tax rule for every shipping
for a given carrier.




Tag
------

This is more a pluginish thing than 
a built-in ekom thing, but I put it here because it was on my notes (as to not forget).






Discount_rule
----------------

This is a very interesting table in terms of how discounts are implemented in ekom.

It was done for preserving consistency of the rule and thus enhance the overall simplicity of the system. 


In ekom, every time we display a product, we parse all the product rules and see if one of them matches.
The same applies for the cart.

This means that there is no mysql bindure of the discount_rule table to any product in particular.

The benefit of this, I believe, is that we have a dynamic rule system: when you say a rule, it's always true.

My first idea was to bind discount rules to the products they were related to, but then I thought that it will
be complicated to try to automate a consistent bindure system: imagine you say that products in category 4 
have a -5% discount until may 5th, then if a new product is added to that category, you need to remember to apply
the discount, or if a product is moved out of the category, you need to remember to remove the discount,
and then the 5th may you need to remember to remove the discount bindures to the products of that category.

And that's just one discount example.
So, instead of remembering all those things, since I really such at remembering,
I prefer to have a one all powerful rule system that is consulted every time we need it.

It might have some impact on performances, but ekom is doing a pretty good job at optimizing this process:
it basically compiles the conditions as a php callback, and so eliminate irrelevant conditions at the
very first loop iteration, so for instance if we are may 8th, it will eliminate the "until 5th may" condition
right at the first iteration, so that all subsequent conditions checking don't suffer this irrelevant condition
checking (perf) penalty.


So, we have a powerful/flexible discount system here, which hopefully encompasses every discount strategy
one can think of.


- type: cart|product, whether this rule applies at the cart level, or at the product level.
                    If product level, it will be considered every time a product is displayed (product page,
                    product list, etc...)
                    The idea is also that when a discount is applied to a product, the label
                    of the discount appears in the corresponding line on the invoice.

- shop_id: 


Discount_rule_lang
----------------
- label

Discount_rule_has_condition
----------------

Discount_rule_has_action
----------------
commands like: addFreeProductInCart, what have you...
I made a quick brainstorming, and you can at least do the following discount types (I let you find the implementation):

- fixed percent discount
- fixed amount discount
- 10€ back if you buy 9 products #44
- buy 2 products #44 and get the third for free



Comment
----------------

A comment is owned by a user in the context of a shop.
It can/should be moderated by a moderator.


- active: 0|1|2, 
        - 0: just posted, no moderator decision involved, not visible on the front
        - 1: accepted by the moderator, and visible on the front
        - 2: refuted by the moderator, and not visible on the front


Product_has_comment
----------------


Feature
----------------

Features might be used as a complementary text to a description.
The intent is to provide small bits of information, probably technically inclined.
For instance, the diameter, the material used, the size, the color, ...

- label


Feature_value
----------------

Feature values are put in a separate table as they might be RE-USED,
like the options in a select that would potentially be common to more than one product.

- value: varchar(512) for now, might be extended to fulltext if required by an implementor



Feature_has_feature
----------------




Resources
=============
Download prestashop languages:
http://doc.prestashop.com/display/PS16/Languages





Appendixes
===============

Order model
--------------

Here is how the order is organized in ekom.

See schema.

From the information below we can recreate an user order.



Order lines are grouped by carrier, since an order might involve more than one carrier method.

We start at the line level.

Each line has a number of info available.
One will probably not use them all, but only a subset.

The available fields are the following:

- reference
- product: the name of the product 
- description: an accurate (contains all attributes info) description of a product reference 
- quantity: how many of this reference have been ordered 
- weight: the weight for one unit of the given reference 
- baseUnitPrice: the price for one unit of the given reference (the raw price, as defined in the backoffice, with nothing applied to it)  
- basePrice: the baseUnitPrice multiplied by the quantity  
- preTaxDiscount: a list of discount labels applied to the basePrice, before the taxes (if any) are applied.

        A discount label shows a human readable summary of all relevant information about a (line/product) discount.
        All those bit of information are still available as separated fields.
        
        A discount is ultimately applied to the product, and can only take one of two forms:
            - a fixed amount discount
            - a percent amount discount
        
        We describe the process of updating the price as applying a discount technique to a price.
        
        The available bit of information are provided as items of the preTaxDiscountItems list.
         
        The preTaxDiscountTechnique and preTaxDiscountTechnique keys (of each item) are all we need to apply the discount.
        The preTaxDiscountLabel field is more of a human reminder.
                    
- preTaxDiscountItems: an array of item, each of which containing the following entries:     
    - preTaxDiscountTechnique: fixed | percent         
    - preTaxDiscountAmount: see preTaxDiscount field        
    - preTaxDiscountValue: see preTaxDiscount field
    
- price: BasePrice x PreTaxDiscount
- tax: a list of tax rules labels applied to the relevant product reference.

            A tax rule label shows an human summary of a tax rule.
             
            A tax rule always applies a percent amount to the price,
            and this percent amount is given as the taxPercent field.
            
            All tax rules labels can be accessed in greater details individually via the taxItems key described hereafter.
            
            When a product has multiple taxes, we can define how those taxes are applied with the
            line.tvaOperator value of an ekom order model, which refernce might be available
            via the shop table (when it's implemented, today is just brainstorming).
            
            
            
- taxItems: an array of item, each of which containing the following entries:
    - taxPercent: the amount of percent of a given tax       
    - taxLabel: the label of the given tax, as defined in the backoffice       

- priceWithTax: the Price with the taxes applied 
- postTaxDiscount: same as preTaxDiscount, but applied on the PriceWithTax
- postTaxDiscountItems: same as preTaxDiscountItems, but for postTaxDiscount     
- totalLine: PriceWithTax with postTaxDiscounts applied 
       
       
       
So all lines are grouped in a so called CarrierGroup, which is just a container for those lines.
The CarrierGroup also brings its own fields into the mix:
       
- basePriceSubtotal: the sum of the "basePrice" column of all lines in this group        
- priceSubtotal: the sum of the "price" column of all lines in this group        
- priceWithTaxSubtotal: the sum of the "priceWithTax" column of all lines in this group        
- totalLineSubtotal: the sum of the "totalLine" column of all lines in this group        
- carrierInfo: a carrier summary of info related to the carrier      
- carrierLabel: the label of the carrier        
- carrierTechnique: fixed | percent, same principle as a preTaxDiscountItems item        
- carrierAmount: 
- priceCarrierGroupSubtotal: the priceSubtotal value, with carrier pricing strategy applied to it 
- priceWithTaxCarrierGroupSubtotal: the priceWithTaxSubtotal value, with carrier pricing strategy applied to it 
- totalLineCarrierGroupSubtotal: the totalLineSubtotal value, with carrier pricing strategy applied to it 
- totalWeight: the sum of all weights (multiplied by the relevant quantities) 
- carrierGroupSubtotal: this field is a little different,
                        it takes the value of one of the following keys:
                            - priceCarrierGroupSubtotal
                            - priceWithTaxCarrierGroupSubtotal
                            - totalLineCarrierGroupSubtotal
                            
                        The goal is that the value selected will be used to compute the grand total of the order.                            
                        The choice depends on the carrierSubtotalTarget key, which might find its way to the shop
                        table at the time of implementation.
- lineItems: list of all line items, each of which containing the array described previously
       
       
Now it's time for the grand finale.       
All those groups are mixed together in a total section, which contains the following fields:

- basePriceTotal: sum of the "basePriceSubtotal" columns of every CarrierGroup
- priceTotal: sum of the "priceSubtotal" columns of every CarrierGroup
- priceWithTaxTotal: sum of the "priceWithTaxSubtotal" columns of every CarrierGroup
- totalLineTotal: sum of the "totalLineSubtotal" columns of every CarrierGroup
- priceCarrierGroupTotal: sum of the "priceCarrierGroupSubtotal" columns of every CarrierGroup
- priceWithTaxCarrierGroupTotal: sum of the "priceWithTaxCarrierGroupSubtotal" columns of every CarrierGroup
- totalLineCarrierGroupTotal: sum of the "totalLineCarrierGroupSubtotal" columns of every CarrierGroup
- totalWeight: sum of the "totalWeight" columns of every CarrierGroup
- carrierGroupTotal: sum of the "carrierGroupSubtotal" columns of every CarrierGroup
- grandTotal: alias for the carrierGroupTotal field
- carrierGroupItems: list of all CarrierGroup items, each of which containing the array described previously
       
       
So, name this big array ekomOrderModel, and voilà! You've got an useful array at your disposal. 
       
       
       
Notes: 
- whether a preTaxDiscount or postTaxDiscount is applied depends on the discount condition/actions set in the backoffice.
       We generally use preTaxDiscount only.
        
- note that a tax can be applied after or before the product is multiplied by the quantity, without affecting the business,
        thanks to the multiplication properties:
        
                    (1 x 10) x 10/100 = (1 x 10/100) x 10
