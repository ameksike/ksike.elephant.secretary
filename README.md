# Secretary Elephant
Lightweight library for data access abstraction, its part of Ksike Framework Elephant distribution is oriented towards the PHP programming language. It belongs to the Ksike project, therefore it is contained within this namespace.

## Libs 
As a technology policy proposed by the Ksike Framework, there are other implementations of this library for other platforms, which are listed below:
+ [Secretary: Ksike Framework Rhino focus on JavaScript and Node.Js](https://github.com/ameksike/ksike.rhino.secretary) 

### How to configure
In this case, the resource called Carrier is used, which abstracts the developers from the process of loading the required library into memory, through the association of routes with namespaces. [for more information about Carrier library access this link](https://github.com/ameksike/ksike.elephant.carrier)

```php
//... step 1: define the Kike namespace in the load handler named Carrier
include __DIR__ . "/lib/carrier/src/Main.php";
Carrier::active(array( 'Ksike'=> __DIR__ .'/../' ));

//... step 2: define the namespaces to use
use Ksike\secretary\src\server\Main as Secretary;
```
Note as in the previous case, it is only necessary to specify the global namespace of the Ksike framework, this is due to the integration with the framework in general, but it is also possible to define for the Carrier only the namespace of the required library.

Once the Secretary library is loaded, it is necessary to configure it, specifying the required parameters depending on the controller and using which can be:

+ pgsql: PostgreSQL database server support
+ mysql / mysqli: support for MySQL database server
+ sqlite: support for SQLite database server
+ sqlsrv: SQL Server database server support

It is also possible to create custom drivers for the required database manager. 

### How to set up the library
```php
//... step 1: Structure and load the required configuration variables based on the specified driver, 
$config["db"]["driver"]		= "pgsql";
$config["db"]["host"]		= "localhost";		   
$config["db"]["user"]		= "postgres";	
$config["db"]["pass"]		= "postgres";	
$config["db"]["name"]		= "mydb";	

//... step 2: enter the settings to the library
$dbmanager = new Secretary($config['db']);

//... step 3: run query
$out = $dbmanager->query('SELECT * FROM person');
```

### How to start using the library there can be two ways, in this case instantiation is not required
```php
//... step 1: Structure and load the required configuration variables based on the specified driver
$config["db"]["driver"]		= "sqlite";	
$config["db"]["log"]		= "log/";		   
$config["db"]["name"]		= "ploy";	
$config["db"]["path"]		= __DIR__ . "/data/";	
$config["db"]["extension"]	= "db";	

//... step 2: enter the settings to the library
Secretary::this()->setting($config);

//... step 3: run query
$out = Secretary::this()->query('SELECT * FROM user');
```

### How to create insert query with format validation for input variables
```php
Secretary::this()->query(sprintf(
	'INSERT INTO "user" ("name", "age", id) VALUES ("%s", %d, %d);',
	33,
	1
));
```

## How to create a new custom driver
This library involves a component-based architecture, allowing developers to extend their behavior. In case you require a controller for any non-existent database manager, its implementation is very simple. You must create a folder with the name of the driver in lowercase inside the directory lib, inside it defines a directory called src and inside it create a file Main.php which will contain the implementation.

### For this example, the driver named mydriver will be created: ./lib/mydriver/src/Main.php, with a structure similar to the one shown below:

```php
namespace Ksike\secretary\lib\mysql\src;
use Ksike\secretary\src\server\Driver as Driver;
class Main extends Driver
{
	public function __construct($config){}

	public function query($sql){}

	public function connect(){}

	public function disconnect(){}

	public function extract($count){}
}
```
