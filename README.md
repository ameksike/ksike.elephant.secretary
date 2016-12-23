# secretary-elephant
Librería ligera para abstracción de acceso a dato, su distro Elephant está orientada al lenguaje de programación PHP. Pertenece al proyecto Ksike por ello está contenida dentro de dicho espacio de nombres.

```php
	/*
	 * Ejemplo de utilizacion del la biblioteca Secretary
	 * */
	 
	//... paso 1: definir el espacio de nombres Ksike en el manejador de carga denominado Carrier
	include __DIR__ . "/lib/carrier/src/Main.php";
	Carrier::active(array( 'Ksike'=> __DIR__ .'/../' ));
	
	//... paso 2: definir los espacios de nombres a utilizar
	use Ksike\secretary\src\server\Main as Secretary;
	
	//... paso 3: configurar el Loader especificandole las direcciones de las dependencias
	Loader::active(array( 'Secretary'=>'lib/secretary'));
	//... paso 4: cargar las variables de configuracion 
	$config["db"]["host"]		= "localhost";		    //... servidor o proveedor de bases de datos
	$config["db"]["user"]		= "postgres";		    //... usuario de una cuenta activa en el servidor de bases de datos
	$config["db"]["pass"]		= "postgres";			//... contraseña requerida para la cuenta activa en el servidor de bases de datos
	$config["db"]["name"]		= "mydb";		        //... nombre de la base de datos a la cual debe conectarse
    $config["db"]["driver"]		= "pgsql";				//... pgsql|mysql|mysqli|sqlite|sqlsrv
	
	//... paso 5: comenzar a utilizar el Secretary
	$dbmanager = new Secretary($config['db']);
	$out = $dbmanager->query('SELECT * FROM person');
	show($out);
```