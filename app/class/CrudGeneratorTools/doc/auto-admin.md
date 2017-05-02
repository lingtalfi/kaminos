Auto-Admin
===============
2017-05-02


It's all about lists and forms,
or to be more precise: how do you generate the lists and forms for a given set of tables.


One of the greatest problem we will have to tackle is that both lists and forms need to react to the relationship between tables.

For instance, imagine the following schema with two tables, where an user owns a car.


```txt
- table user
----- id
----- name
----- pass

- table car
----- id
----- user_id: (foreign key)
----- model
----- price
```


Given that structure, one thing that we would like is the option to choose between those 
two representations of a car list:


representation with the user_id as user_id:
-------------------------

```txt
id      user_id     model               price
1       1           volkswagen          10
2       1           fiat                100
3       2           chrysler            100
```


representation with the user.name as user_id:
-------------------------

```txt
id      user_id     model               price
1       paul        volkswagen          10
2       paul        fiat                100
3       emilie      chrysler            100
```


Actually, it might make even more sense if we could also change the column names, like in the following example:


representation with the user.name as user_id:
-------------------------

```txt
id      user_name     model               price
1       paul        volkswagen          10
2       paul        fiat                100
3       emilie      chrysler            100
```


That should give you an idea of the problem with list.


Now for forms, imagine that we want to generate a form for inserting a car in the database,
then we have a similar problem, as exposed below:


representation with the user_id as user_id:
-------------------------

```txt
model: input
price: input
user_id: select
            - 1
            - 2
            - 3
```

representation with the user_name as user_id:
-------------------------

```txt
model: input
price: input
user_id: select
            - paul
            - emilie
            - johan
```


representation with the user_name as user_id, and the column name user_id changed to user_name
-------------------------

```txt
model: input
price: input
user_name: select
            - paul
            - emilie
            - johan
```


So, now you should have an understanding of the biggest problem we need to resolve.

So now we will go into the details of what kind of tools we want to provide in order to help an auto-admin implementor 
do her job.
 
 
 
 
First, we will get started by making the assumption that the implementor will need to generate files, one per table and one per type.
So for instance, she will need to generate a structure like this for instance (file names and dir names might change):
 
```txt
- auto-generated-list/
----- db1.table1.php
----- db1.table2.php
----- ...
- auto-generated-form/
----- db1.table1.php
----- db1.table2.php
----- ...
``` 

So, we already know that we will need to iterate over the database(s) tables.
 
Also, we don't know what's inside the table1.php files (that's because there are as many possible implementations as 
there are implementors), so we won't be able to generate the concrete content of those files, but only provide tools 
that will help generate that content.

So our strategy will be to estimate the kind of things those files need, and provide relevant tools to help with the job
of providing those things.


To make things simple, we will make one tool for helping with lists, and another for helping with forms,
and both will extend a common CrudGeneratorHelper class.

 
```txt
- CrudGeneratorHelper
----- ListCrudGeneratorHelper
----- FormCrudGeneratorHelper
``` 

This allows us to have the iteration method at the CrudGeneratorHelper level, thus available to both list and form generators.

- setDatabases( array databases)
- getTables(db=null, useDbPrefix=true)
    - if the db is not specified, this method will iterate over every database provided with the setDatabases method


 
 
 
Lists
==============



 











 
 
 
 


