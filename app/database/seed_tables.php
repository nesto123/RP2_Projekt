<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_users();
seed_table_restaurants();
seed_table_food();
seed_table_food_type();
seed_table_orders();
seed_table_contains();
seed_table_has_food_type();
seed_table_deliverers();
seed_table_neighborhood();

exit( 0 );

// ------------------------------------------
function seed_table_users()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_users(username, password_hash, email, address,  registration_sequence, has_registered) VALUES (:username, :password, \'a@b.com\', :address, \'abc\', \'1\')' );

		$st->execute( array( 'username' => 'mirko', 'password' => password_hash( 'mirkovasifra', PASSWORD_DEFAULT ), 'address' => 'Tratinska 10') );
		$st->execute( array( 'username' => 'slavko', 'password' => password_hash( 'slavkovasifra', PASSWORD_DEFAULT ), 'address' => 'Ulica Nike Grškovića 23' ) );
		$st->execute( array( 'username' => 'ana', 'password' => password_hash( 'aninasifra', PASSWORD_DEFAULT ), 'address' => 'Ulica kralja Zvonimira 57' ) );
		$st->execute( array( 'username' => 'maja', 'password' => password_hash( 'majinasifra', PASSWORD_DEFAULT ), 'address' => 'Veslačka ulice 6' ) );
		$st->execute( array( 'username' => 'pero', 'password' => password_hash( 'perinasifra', PASSWORD_DEFAULT ), 'address' => 'Ulica Radoslava Cimermana 14' ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_users]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_users.<br />";
}


// ------------------------------------------
function seed_table_restaurants()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_restaurants(username, password_hash, name, address, email, registration_sequence, description, has_registered) VALUES (:username, :password, :name, :address, \'a@b.com\', \'abc\', :description, \'1\')' );

		$st->execute( array( 'username' => 'pizzeria6', 'password' => password_hash( 'pizzeria6sifra', PASSWORD_DEFAULT ), 'name' => 'Pizzeria 6',  'address' => 'Medulićeva 6', 'description' => 'U ugodnom ambijentu Pizzeria 6 u samom centru Zagreba. Kušajte najbolje pizze iz krušne peći, te ostale delicije.' ) );
		$st->execute( array( 'username' => 'bros', 'password' => password_hash( 'brossifra', PASSWORD_DEFAULT ), 'name' => 'Pizzeria Bros',  'address' => 'Trakošćanska 28', 'description' => 'Provedite večer kod nas uz tradicionalnu kuhinju i sve njezine specijalitete.' ) );
		$st->execute( array( 'username' => 'rocket', 'password' => password_hash( 'rocketsifra', PASSWORD_DEFAULT ), 'name' => 'Rocket Burger',  'address' => 'Tkalčićeva 50', 'description' => ' Rocket Burger poznati je zagrebački burger bar u Tkalčićevoj ulici, koji je uvijek pazio na kvalitetu svojih sendviča.') );
		$st->execute( array( 'username' => 'submarine', 'password' => password_hash( 'submarinesifra', PASSWORD_DEFAULT ), 'name' => 'Submarine',  'address' => 'Frankopanska 9', 'description' => 'Submarine su gurmanski burgeri vrhunske kvalitete.') );
		$st->execute( array( 'username' => 'batak', 'password' => password_hash( 'bataksifra', PASSWORD_DEFAULT ), 'name' => 'Batak Grill',  'address' => 'Radnička cesta 37b', 'description' => 'BATAK GRILL odavno je poznata destinacija svim gurmanima koji uživaju u hrani!') );
		$st->execute( array( 'username' => 'kokopeli', 'password' => password_hash( 'kokopelisifra', PASSWORD_DEFAULT ), 'name' => 'Kokopeli',  'address' => 'Ukrinska 5', 'description' => 'Osim stalne ponude jela od mesa, roštilja, salata, palačinki, tjestenina i rižota, tu je i svakodnevna raznolika ponuda dnevnih gableca po povoljnim cijenama.' ) );
		$st->execute( array( 'username' => 'ribs', 'password' => password_hash( 'ribssifra', PASSWORD_DEFAULT ), 'name' => 'R&B Food House Of Ribs',  'address' => 'Puljska 9', 'description' => 'R&B Food restoran se bazira na viziji zdrave hrane s naglaskom na kvalitetu i jednostavnost.') );
		$st->execute( array( 'username' => 'koykan', 'password' => password_hash( 'pekingsifra', PASSWORD_DEFAULT ), 'name' => 'Kineski restoran Peking',  'address' => 'Ilica 114', 'description' => 'Riječ je o jednom od prvih zagrebačkih azijskih restorana koji nudi vrhunska jela iz bogate kineske gastronomske tradicije.' ) );
		$st->execute( array( 'username' => 'peking', 'password' => password_hash( 'koykansifra', PASSWORD_DEFAULT ), 'name' => 'Koykan World Food - Tkalčićeva',  'address' => 'Ul. Ivana Tkalčića 13', 'description' => 'Koykan World Food vam nudi mnoštvo okusa iz raznih dijelova svijeta. Mjesto je koje svojom ponudom osvježava i donosi novo iskustvo.') );
		$st->execute( array( 'username' => 'zagabria', 'password' => password_hash( 'zagabriasifra', PASSWORD_DEFAULT ), 'name' => 'Pizzeria Zagabria',  'address' => 'Ilica 202', 'description' => 'Kod nas mozete naci vrhunske pizze naseg pizzaiola sa 25 godina iskustva,lasagne,pohana jela te jela sa rostilja,sve radimo u skladu sa haccap-om.') );
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_restaurants]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_restaurants.<br />";
}


// ------------------------------------------
function seed_table_food()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_food(name, description, waiting_time, id_restaurant, price, in_offering, image_path) VALUES (:name, :description, :waiting_time, :id_restaurant, :price, :in_offering, :image_path)' );

		$st->execute( array( 'name' => 'Pizza Modena',  'description' => '(pelat, mozzarela, pršut, rikola,maslina)', 'waiting_time' => 25, 'id_restaurant' => 1, 'price' => 62, 'in_offering' => 1, 'image_path' => '/app/images/food/1.jpg' ) );
		$st->execute( array( 'name' => 'Pizza 6',  'description' => '(pelat, sir, šunka, špek, šampinjoni, jaje, blagi i ljuti feferoni, maslina)', 'waiting_time' => 25, 'id_restaurant' => 1, 'price' => 58, 'in_offering' => 1, 'image_path' => '/app/images/food/2.jpg'  ) );
		$st->execute( array( 'name' => 'Pizza Napoletana', 'description' => '(pelat, mozzarela, inćuni, masline, cherry rajčice, bosiljak)', 'waiting_time' => 25, 'id_restaurant' => 1, 'price' => 58, 'in_offering' => 1, 'image_path' => '/app/images/food/3.jpg'  ) );
		$st->execute( array( 'name' => 'Pizza Piccante', 'description' => '(pelat, sir, šunka, špek, feferoni, maslina)', 'waiting_time' => 30, 'id_restaurant' => 1, 'price' => 54, 'in_offering' => 1, 'image_path' => '/app/images/food/4.jpg'  ) );
		$st->execute( array( 'name' => 'Pizza Capriccosia', 'description' => '(pelat, šunka, sir, šampinjoni, maslina)', 'waiting_time' => 20, 'id_restaurant' => 1, 'price' => 52, 'in_offering' => 1, 'image_path' => '/app/images/food/5.jpg'  ) );		

		$st->execute( array( 'name' => 'Pizza Capricciosa', 'description' => '(rajčica, Fior di Latte, Cotto šunka, šampinjoni, artičoke, masline, maslinovo ulje)', 'waiting_time' => 30, 'id_restaurant' => 2, 'price' => 68, 'in_offering' => 1, 'image_path' => '/app/images/food/5.jpg'  ) );
		$st->execute( array( 'name' => 'Pizza Oro Nero', 'description' => '(rajčica, Fior di Latte, Cotto šunka, tartufat, svježi bosiljak)', 'waiting_time' => 20, 'id_restaurant' => 2, 'price' => 72, 'in_offering' => 1, 'image_path' => '/app/images/food/7.jpg'  ) );
		$st->execute( array( 'name' => 'Pizza Piccnte', 'description' => '(rajčica, Fior di Latte, pikantna salama, svježa paprika)', 'waiting_time' => 35, 'id_restaurant' => 2, 'price' => 72, 'in_offering' => 1, 'image_path' => '/app/images/food/8.jpg'  ) );
		$st->execute( array( 'name' => 'Pizza Ragina', 'description' => '(rajčica, Fior di Latte, Cotto šunka, šampinjoni)', 'waiting_time' => 20, 'id_restaurant' => 2, 'price' => 55, 'in_offering' => 1, 'image_path' => '/app/images/food/9.jpeg'  ) );

		$st->execute( array( 'name' => 'Cheddar Bacon Supreme', 'description' => '(Brioche pecivo, juneća pljeskavica, salata, luk ceddar sir, slanina)', 'waiting_time' => 20, 'id_restaurant' => 3, 'price' => 60, 'in_offering' => 1 , 'image_path' => '/app/images/food/10.jpg' ) );
		$st->execute( array( 'name' => 'Rocket Burger', 'description' => '(Brioche pecivo, juneća pljeskavica, majoneza s medom i chipotle papričicom, gauda sir, slanina, lik)', 'waiting_time' => 25, 'id_restaurant' => 3, 'price' => 55, 'in_offering' => 1, 'image_path' => '/app/images/food/11.jpeg'  ) );
		$st->execute( array( 'name' => 'Cheeseburger', 'description' => '(Brioche pecivo, juneća pljeskavica, salata, majoneza s medom i chipotle papričicom, gauda sir, svježa rajčica, luk)', 'waiting_time' => 25, 'id_restaurant' => 3, 'price' => 45, 'in_offering' => 1, 'image_path' => '/app/images/food/12.jpg'  ) );

		$st->execute( array( 'name' => 'French', 'description' => '(govedina, brie sir, umak od bijelog tartufa)', 'waiting_time' => 25, 'id_restaurant' => 4, 'price' => 56, 'in_offering' => 1, 'image_path' => '/app/images/food/13.jpg'  ) );
		$st->execute( array( 'name' => 'Smokehouse', 'description' => '(govedina, salata, pršut, sir, BBQ umak)', 'waiting_time' => 30, 'id_restaurant' => 4, 'price' => 48, 'in_offering' => 1, 'image_path' => '/app/images/food/14.jpg'  ) );
		$st->execute( array( 'name' => 'Monster', 'description' => '(govedina, Submarine umak, topljeni sir, pršut, BBQ umak)', 'waiting_time' => 20, 'id_restaurant' => 4, 'price' => 68, 'in_offering' => 1, 'image_path' => '/app/images/food/15.jpg'  ) );
		$st->execute( array( 'name' => 'Tipsy Plum', 'description' => '(govedina, crveni kupus, hrskava panceta, domaći senf i umak od meda)', 'waiting_time' => 30, 'id_restaurant' => 4, 'price' => 56, 'in_offering' => 1, 'image_path' => '/app/images/food/16.jpg'  ) );
		$st->execute( array( 'name' => 'Avokado Veggie', 'description' => '(avokado, Submarine umak, dimljeni tofu sa curryjem, svježa rukola)', 'waiting_time' => 15, 'id_restaurant' => 4, 'price' => 50, 'in_offering' => 1, 'image_path' => '/app/images/food/17.jpg'  ) );

		$st->execute( array( 'name' => 'Plata Batak', 'description' => '(ćevapi sa sirom, punjena vješalica, pljeskavica, kriške mladog krupmira, šampinjoni)', 'waiting_time' => 50, 'id_restaurant' => 5, 'price' => 165, 'in_offering' => 1, 'image_path' => '/app/images/food/18.jpeg'  ) );
		$st->execute( array( 'name' => 'BBQ rebarca', 'description' => '(svinjska rebarca u BBQ umaku)', 'waiting_time' => 40, 'id_restaurant' => 5, 'price' => 72, 'in_offering' => 1, 'image_path' => '/app/images/food/19.jpeg'  ) );
		$st->execute( array( 'name' => 'Punjeni lungić', 'description' => '(svinjski lungić punjen sirom)', 'waiting_time' => 30, 'id_restaurant' => 5, 'price' => 71, 'in_offering' => 1, 'image_path' => '/app/images/food/20.jpg'  ) );
		$st->execute( array( 'name' => 'Ćevapi', 'description' => '(juneći ćevapi, 10 kom)', 'waiting_time' => 20, 'id_restaurant' => 5, 'price' => 45, 'in_offering' => 1, 'image_path' => '/app/images/food/21.jpg'  ) );
		$st->execute( array( 'name' => 'BBQ krilca', 'description' => '(pileća krilca u BBQ umaku)', 'waiting_time' => 35, 'id_restaurant' => 5, 'price' => 42, 'in_offering' => 1, 'image_path' => '/app/images/food/2.jpg'  ) );		
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_food]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_food.<br />";
}

function seed_table_food_type()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_food_type(name,image_path) VALUES (:id_name, :image_path)' );

		$st->execute( array( 'id_name' => 'pizza',  'image_path' => '/app/images/foodType/pizza.jpg') );
		$st->execute( array( 'id_name' => 'burger', 'image_path' => '/app/images/foodType/burger.jpg') );
		$st->execute( array( 'id_name' => 'grill', 'image_path' => '/app/images/foodType/grill.jpg' ) );

	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_food_type]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_food_type.<br />";
}

function seed_table_orders()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_orders(id_user, id_restaurant, active, delivery_time, note, address, feedback, rating, thumbs_up, thumbs_down) VALUES (:id_user, :id_restaurant, :active, :delivery_time, :note, :address, :feedback, :rating, :thumbs_up, :thumbs_down)' );

		$st->execute( array( 'id_user' => 1, 'id_restaurant' => 3, 'active' => 2, 'delivery_time' => NULL, 'note' => '', 'address' => 'Tratinska 10', 'feedback' => '', 'rating' => 5, 'thumbs_up' => 5, 'thumbs_down' =>  0) );
		$st->execute( array( 'id_user' => 1, 'id_restaurant' => 3, 'active' => 0, 'delivery_time' => date('Y-m-d H:i:s'), 'note' => '', 'address' => 'Tratinska 10', 'feedback' => 'sdh', 'rating' => 4, 'thumbs_up' => 1, 'thumbs_down' =>  0) );
		$st->execute( array( 'id_user' => 2, 'id_restaurant' => 1, 'active' => 0, 'delivery_time' => date('Y-m-d H:i:s'), 'note' => '', 'address' => 'Savska 50', 'feedback' => 'dfhs', 'rating' => 2, 'thumbs_up' => 0, 'thumbs_down' =>  2) );
		$st->execute( array( 'id_user' => 3, 'id_restaurant' => 2, 'active' => 0, 'delivery_time' => date('Y-m-d H:i:s'), 'note' => '', 'address' => 'Ulica kralja Zvonimira 57', 'feedback' => 'ghn', 'rating' => 5, 'thumbs_up' => 2, 'thumbs_down' =>  1) );
		$st->execute( array( 'id_user' => 3, 'id_restaurant' => 5, 'active' => 2, 'delivery_time' => NULL, 'note' => '', 'address' => 'Radnička 80', 'feedback' => '', 'rating' => 6, 'thumbs_up' => 0, 'thumbs_down' =>  2) );
		$st->execute( array( 'id_user' => 4, 'id_restaurant' => 5, 'active' => 2, 'delivery_time' => NULL, 'note' => '', 'address' => 'Ulica Radoslava Cimermana 14', 'feedback' => '', 'rating' => 8, 'thumbs_up' => 3, 'thumbs_down' =>  5) );

	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_orders]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_orders.<br />";
}

function seed_table_contains()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_contains(id_order, id_food, quantity) VALUES (:id_order, :id_food, :quantity)' );

		$st->execute( array( 'id_order'=> 1, 'id_food'=> 10, 'quantity' => 2) );
		$st->execute( array( 'id_order'=> 2, 'id_food'=> 10, 'quantity' => 1) );
		$st->execute( array( 'id_order'=> 3, 'id_food'=> 1, 'quantity' => 2) );
		$st->execute( array( 'id_order'=> 4, 'id_food'=> 8, 'quantity' => 3) );
		$st->execute( array( 'id_order'=> 5, 'id_food'=> 20, 'quantity' => 1) );
		$st->execute( array( 'id_order'=> 6, 'id_food'=> 21, 'quantity' => 1) );

	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_contains]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_contains.<br />";
}


function seed_table_has_food_type()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_has_food_type(id_foodType, id_restaurant) VALUES (:id_foodType, :id_restaurant)' );

		$st->execute( array( 'id_foodType'=> 1, 'id_restaurant'=> 1) );
		$st->execute( array( 'id_foodType'=> 1, 'id_restaurant'=> 2) );
		$st->execute( array( 'id_foodType'=> 2, 'id_restaurant'=> 3) );
		$st->execute( array( 'id_foodType'=> 2, 'id_restaurant'=> 4) );
		$st->execute( array( 'id_foodType'=> 3, 'id_restaurant'=> 5) );

	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_has_food_type]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_has_food_type.<br />";
}

//-----------------------------------------------
function seed_table_deliverers()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_deliverers(username, password_hash, email, registration_sequence, has_registered) VALUES (:username, :password, \'a@b.com\', \'abc\', \'1\')' );

		$st->execute( array( 'username' => 'petar', 'password' => password_hash( 'petrovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'ivan', 'password' => password_hash( 'ivanovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'matej', 'password' => password_hash( 'matejevasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'iva', 'password' => password_hash( 'ivinasifra', PASSWORD_DEFAULT ) ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_deliverers]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_deliverers.<br />";
}


function seed_table_neighborhood()
{
	$db = DB::getConnection();

	try
	{
		$st = $db->prepare( 'INSERT INTO spiza_neighborhood(id_restaurant, neighborhood) VALUES (:id_restaurant, :neighborhood)' );

		$st->execute( array( 'id_restaurant' => '1', 'neighborhood' => 'Centar' ) );
		$st->execute( array( 'id_restaurant' => '2', 'neighborhood' => 'Trešnjevka' ) );
		$st->execute( array( 'id_restaurant' => '3', 'neighborhood' => 'Centar' ) );
		$st->execute( array( 'id_restaurant' => '4', 'neighborhood' => 'Centar'  ) );
		$st->execute( array( 'id_restaurant' => '5', 'neighborhood' => 'Pešćenica'  ) );
		$st->execute( array( 'id_restaurant' => '6', 'neighborhood' => 'Kruge'  ) );
		$st->execute( array( 'id_restaurant' => '7', 'neighborhood' => 'Ljubljanica'  ) );
		$st->execute( array( 'id_restaurant' => '8', 'neighborhood' => 'Centar'  ) );
		$st->execute( array( 'id_restaurant' => '9', 'neighborhood' => 'Centar'  ) );
		$st->execute( array( 'id_restaurant' => '10', 'neighborhood' => 'Centar'  ) );

		
	}
	catch( PDOException $e ) { exit( "PDO error [insert spiza_neighborhood]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu spiza_neighborhood.<br />";
}
?> 
 
 
