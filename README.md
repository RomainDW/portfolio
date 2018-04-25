Portfolio : Symfony 3.4
========================

This is a portfolio made with Symfony 3.4.

Installation
---------

- install the database (portfolio.sql)
- install wkhtmltopdf and configure his path in config.yml (https://wkhtmltopdf.org/downloads.html)
- create a twitter and facebook application and fill in the requested parameters in parameters.yml
```bash
composer install
php bin/console server:run
```

Bundle
---------

- KnpPaginatorBundle for the pagination
- FOSJsRoutingBundle for the routing into js files
- StfalconTinymceBundle for the WYSIWYG editor
- KnpSnappyBundle for the PDF generator
