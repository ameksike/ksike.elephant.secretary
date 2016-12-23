<?php
/* 
 *
 * @author: Antonio Membrides Espinosa
 * @mail: ameksike@gmail.com
 * @created: 23/04/2011 
 * @updated: 23/04/2011 
 * @description: This is simple and Light Driver for MySql DBSM 
 * @require: PHP >= 5.3.*, libphp5-mysqli
 * 
 */
namespace Ksike\secretary\lib\mysqli\src;
use Ksike\secretary\src\server\Driver as Driver;
class Main extends Driver
{
	public $user;   
	public $pass;    
	public $host; 
	public $port;  

	public function __construct($config)
	{
		$this->name = 'default';
		$this->user = 'root';   
		$this->pass = 'root';    
		$this->host = 'localhost'; 
		$this->port = '3306';  
		parent::__construct($config);
	}

	public function query($sql)
	{
		$this->connect();
		$out = mysql_query($sql);
		$this->records[] = $sql;
		$out = $this->selected($sql) ? $this->extract($out) : $out;
		$this->disconnect();
		return $out;
	}

	public function connect()
	{
		//... falta ...
	}

	public function disconnect()
	{
		//... falta ...
	}

	public function extract($count){
		//... falta ...
	}
}
