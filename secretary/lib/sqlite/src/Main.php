<?php
/*
 *
 * @author: Antonio Membrides Espinosa
 * @mail: ameksike@gmail.com
 * @created: 23/04/2011
 * @updated: 23/04/2011
 * @description: This is simple and Light Driver for SQLite DBSM
 * @require: PHP >= 5.3.*, libphp5-sqlite
 *
 */
namespace Ksike\secretary\lib\sqlite\src;
use Ksike\secretary\src\server\Driver as Driver;
class Main extends Driver
{
    public $dbm;
    public $path;

    public function __construct($config)
    {
        $this->path = false;
        $this->dbm = false;
        $this->extension = 'db';
        parent::__construct($config);
    }

    public function setting ($key=false, $value=false){
        parent::setting($key, $value);
		return $this;
    }
    public function query($sql)
    {
		$this->connect();
		$out = false;
		if($this->selected($sql) ){
			$stmt = @$this->dbm->prepare($sql);
			$out = @$stmt->execute();
			$out = $this->extract($out);
		}else{
			$out = @$this->dbm->exec($sql);
			if(!$out) echo " ERROR: ". $this->dbm->lastErrorCode()." -->> ". $this->dbm->lastErrorMsg()." in: $sql <br>";
		}
		if (!$out) {
            $this->log('ERROR: ' . $this->dbm->lastErrorMsg());
            return false;
        }
		$this->records[] = $sql;
		$this->disconnect();
		return $out;
    }

    public function connect()
    {
		$this->dbm = new \SQLite3($this->dsn());
    }

    public function disconnect()
    {
        $this->dbm->close();
    }

    public function extract($results){
        if(!$results) return false;
        $res = array();
        while ($res[] = $results->fetchArray(SQLITE3_ASSOC));
        return $res;
    }

	public function dsn()
	{
		if($this->path === ':memory:') return $this->path;
		if(file_exists($this->name))
			return $this->name;
		if(file_exists($this->path . $this->name))
			return $this->path . $this->name;
		if(file_exists($this->path . $this->name . "." . $this->extension))
			return $this->path . $this->name . "." . $this->extension;
		return ':memory:';
	}
}
