# Slim 3 - a microframework for PHP

This is a simple Slim PHP micro framework application that manages a list of items (jewerly)

Run git clone command from the directory in which you want to install your new Rest API application.

	git clone https://github.com/zeroOneTwo3/restAPI-jewerly.git

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

# Composer

This project uses Composer. To run the application in development, you can run these commands 

	cd restAPI-jewerly
	php composer.phar install
  
The full list of methods is displayed below:

| URL				| HTTP-method	| Operation					|
|-------------------------------|---------------|-----------------------------------------------|
| /api/items			| GET		| Returns an array of items			|
| /api/items/[number]		| GET		| Returns the item with id=number		|
| /api/categories		| GET		| Returns an array of categories		|
| /api/items/edit/[number]	| GET		| Open form for editing	item with id=number	|
| /api/items/edit/[number]	| PUT		| Update item with id=number			|
