<?php 

	define("DB_HOST", "localhost");
	define("DB_NAME", "test");
	define("DB_USER", 'root');
	define("DB_PASS", '');
	define("PROJECT", "Paris_Crud");

	ORM::configure('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME);
    ORM::configure('username' , DB_USER);
    ORM::configure('password' ,DB_PASS);
    ORM::configure('return_result_sets',true);


 ?>