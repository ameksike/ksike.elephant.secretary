<?php
	/*
	 * Ejemplo de utilización de la biblioteca Ksike/Secretary para conexión a base de datos SQLite
	 * */
	 
	//... paso 1: definir el espacio de nombres Ksike en el manejador de carga denominado Carrier
	include __DIR__ . "/lib/carrier/src/Main.php";
	Carrier::active(array( 'Ksike'=> __DIR__ .'/../' ));
	
	//... paso 2: definir los espacios de nombres a utilizar
	use Ksike\secretary\src\server\Main as Secretary;
	
	//... paso 3: cargar las variables de configuracion 
	$config["log"]		 = "log/";
    $config["driver"]	 = "sqlite";			//... valores admitidos: pgsql|mysql|mysqli|sqlite|sqlsrv
	$config["name"]		 = "ploy";		        //... nombre de la base de datos a la cual debe conectarse
	$config["path"]		 = __DIR__ . "/data/";	//... ruta donde se encuentra la base de datos
	$config["extension"] = "db";				//... default value db
	
	//... paso 4: crear una instancia de Secretary o utilizar un objeto global contenido en la funcion Secretary::this()
	//$dbmanager = new Secretary();
	
	//... paso 5: especificar los elementos de configuración  necesarios
	Secretary::this()->setting($config);
	
	//... paso 6: ejecutar una consulta de selección 
	$out = Secretary::this()->query('SELECT * FROM user');
	//print_r($out);
	
	//... paso 7: crear una vista denominada usrs
	$out = Secretary::this()->query('CREATE VIEW usrs AS SELECT * FROM user;');
	$out = Secretary::this()->query('SELECT * FROM usrs');
	//print_r($out);

	//... paso 8: ejecutar una consulta de inserción 
	Secretary::this()->query('INSERT INTO "user" ("name", "age", id) VALUES ("Janny", "33", "99");');
	
	//... simplificando la configuracion 
	$config["name"]		 = __DIR__ . "/data/ploy.db";	//... ruta donde se encuentra la base de datos
	Secretary::this()->setting($config);
	$out = Secretary::this()->query('SELECT * FROM user');
	
	//... listando los elementos obtenidos 
	foreach($out as $i){
		echo " {$i['name']} - <br>  \n";
	}