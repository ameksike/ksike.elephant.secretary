# secretary-elephant
Librería ligera para abstracción de acceso a dato, su distro Elephant está orientada al lenguaje de programación PHP.

```php
	/*
	 * Ejemplo de utilizacion del la biblioteca LQLS, equivalente a: LQL sobre Secretary
	 * */
	 
	//... paso 1: incluir el Loader y las funciones utilies (cfg|show)
	include "lib/loader/Main.php";
	include "lib/utils.php";
	
	//... paso 2: los espacios de nombres a utilizar
	use Loader\Main as Loader;
	use Secretary\src\server\Main as Secretary;
	
	//... paso 3: configurar el Loader especificandole las direcciones de las dependencias
	Loader::active(array( 'Secretary'=>'lib/secretary'));
	//... paso 4: cargar las variables de configuracion 
	$config["db"]["host"]		= "localhost";		    //... servidor o proveedor de bases de datos
	$config["db"]["user"]		= "postgres";		    //... usuario de una cuenta activa en el servidor de bases de datos
	$config["db"]["pass"]		= "postgres";			//... contraseña requerida para la cuenta activa en el servidor de bases de datos
	$config["db"]["name"]		= "mydb";		        //... nombre de la base de datos a la cual debe conectarse
    $config["db"]["driver"]		= "sqlite";				//... pgsql|mysql|mysqli|sqlite|sqlsrv
	$config["db"]["log"]		= "log/";
	$config["db"]["path"]		= "data/";
	
	//... paso 5: comenzar a utilizar el Secretary
	$dbmanager = new Secretary($config['db']);
	$out = $dbmanager->query('SELECT * FROM person');
	show($out);
```