<?php


class spdo extends PDO {


	private static $instance;
	
	private static $query = '';


	public function __construct( ) {
	
	}

	//Singleton
	public static function getInstance() {
		if (!in_array(DB_TYPE, self::drivers())) {
			die('Type de base de donnée inconnue !');
		}
		try {
			switch(DB_TYPE) {
				case "mssql":
					self::$instance = new PDO("mssql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
					break;
				case "sqlsrv":
					self::$instance = new PDO("sqlsrv:server=".DB_HOST.";database=".DB_NAME, DB_USER, DB_PASS);
					break;
				case "ibm": //default port = ?
					self::$instance = new PDO("ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=".DB_NAME."; HOSTNAME=".DB_HOST.";PORT=".DB_PORT.";PROTOCOL=TCPIP;", DB_USER, DB_PASS);
					break;
				case "dblib": //default port = 10060
					self::$instance = new PDO("dblib:host=".DB_HOST.":".DB_PORT.";dbname=".DB_NAME,DB_USER,DB_PASS);
					break;
				case "odbc":
					self::$instance = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=".DB_HOST.";Uid=".DB_USER);
					break;
				case "oracle":
					self::$instance = new PDO("OCI:dbname=".DB_NAME.";charset=UTF-8", DB_USER, DB_PASS);
					break;
				case "ifmx":
					self::$instance = new PDO("informix:DSN=InformixDB", DB_USER, DB_PASS);
					break;
				case "fbd":
					self::$instance = new PDO("firebird:dbname=".DB_HOST.":".DB_NAME, DB_USER, DB_PASS);
					break;
				case "mysql":
					self::$instance = (is_numeric(DB_PORT)) ? new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS) : new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
					break;
				case "sqlite2": // "sqlite:/path/to/database.sdb"
					self::$instance = new PDO("sqlite:".DB_HOST);
					break;
				case "sqlite3":
					self::$instance = new PDO("sqlite::memory");
					break;
				case "pg":
					self::$instance = (is_numeric(DB_PORT)) ? new PDO("pgsql:dbname=".DB_NAME.";port=".DB_PORT.";host=".DB_HOST, DB_USER, DB_PASS) : new PDO("pgsql:dbname=".DB_NAME.";host=".DB_HOST, DB_USER, DB_PASS);
					break;
				default:
					self::$instance = null;
					break;
			}

			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			//self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
			//self::$instance->setAttribute(PDO::SQLSRV_ATTR_DIRECT_QUERY => true);
			return self::$instance;
		} catch(PDOException $e) {
			$this->err_msg = "Error: ".$e->getMessage();
			return false;
		}

	}
	
	/**
	 * @brief properties, Retourne les possibilités du serveur
	 **/
	public function drivers() {
		return PDO::getAvailableDrivers();
	}
	
	public function query($query) {
		if (self::$instance == null) {
			self::getInstance();
		}
		try {
			self::$query = $query;
			return self::$instance->query(self::$query);
		} catch(PDOException $e) {
			$this->err_msg = "Error: ".$e->getMessage();
			return false;
		}
	}
	
	
}
