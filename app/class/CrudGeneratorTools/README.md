CrudGeneratorTools
======================
2017-05-02




What is it?
=================
The main idea is that you have a schema, and you want to generate an auto-admin tool: a tool
that allows you to interact with all the tables (like phpMyAdmin for instance).

In order to do that, you will probably need to collect all sort of information about the 
tables: what are the foreign keys, what form control do you want to generate depending on the sql type of the column, ...



The CrudGeneratorTools help you do that by providing my thoughts about a general auto-admin system,
and some concrete tools helping the implementation of those ideas.



So first, what's an auto-admin system?
And then, what are the tools.


Auto-admin
==============
This is a big topic, please browse the doc directory of this repository to find the information you would like.



Using the tools
===================

- Initializing QuickPdo

There are two ways to use the generator tools: 

- with a standalone script
- as a script embedded in your application (module, plugin, ...)



Initializing QuickPdo
-----------------------

In both cases, the first step is to initialize a [QuickPdo](https://github.com/lingtalfi/Quickpdo) connection.

Here is how you would it if you use a standalone script:

```php
QuickPdo::setConnection("mysql:dbname=oui;host=127.0.0.1", "root", "root", [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
]);
```

If you use a framework, then you should know how to initialize the pdo connexion.
Or if you don't, just paste/adapt the above snippet somewhere in your code.

