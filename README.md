Basic Url Shortener (BUS)
==========================

This is a Basic but functional Url Shortener.
This script is meant to be your personal Url Shortener.

1) Requeriments
----------------
Needs an Apache (for the .htaccess mod_rewrite), PHP 5.3 and MySql

2) Installing
---------------
To install BUS you have to:
- Execute the link.sql

	** WARNING **
	Executing the link.sql will create a table named "BUS_link" on your database (deleting if exist), be sure you don't have a table named "BUS_link"
	
- Copy includes/config-sample.php to includes/config.php and put your settings

- You can delete the "db" folder and the includes/config-sample.php

3) Enjoying
---------------
You can start doing your first shortlink going to: http://where.you/placed/the/BUS/