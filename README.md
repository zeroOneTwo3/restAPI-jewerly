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
  
# The full list of methods is displayed below:

| URL				| HTTP-method	| Operation								|
|-------------------------------|---------------|-----------------------------------------------------------------------|
| /api/items			| GET		| Returns an array of items						|
| /api/items/[number]		| GET		| Returns the item with id=number					|
| /api/categories		| GET		| Returns an array of categories					|
| /api/items/edit/[number]	| GET		| Open form for editing	item with id=number				|
| /api/items/edit/[number]	| PUT		| Update item with id=number						|
| /api/items/add		| GET		| Open form for creating item						|
| /api/items/add		| POST		| Create the new item							|
| /api/items/delete/[number]	| GET		| Open form for deleting item						|
| /api/items/delete/[number]	| DELETE	| Delete the item with id=number					|
| /api/categories/[number]	| GET		| Returns all items from category with id=number			|
| /api/categories/add		| GET/POST	| See above								|
| /api/categories/edit/[number]	| GET/PUT	| See above								|
| /api/categories/edit/[number]	| DELETE	| Delete category with id=number and all items from this category	|
