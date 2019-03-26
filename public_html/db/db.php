<?php
function init_baza($dbfile) {
	global $db,$kom;
	try {
		if (!file_exists($dbfile)) $kom[]='Próba utworzenia nowej bazy...';
		$db=new PDO("sqlite:$dbfile");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo "Blad przy otwieraniu bazy";
	}
}

function db_exec($qstr) {
	global $db,$kom;
	$kom[]='Wykonuję: '.$qstr.'<br />';
	$ret=null;
	try {
		$ret=$db->exec($qstr);
	} catch(PDOException $e) {
		echo ($e->getMessage());
	}
	return $ret;
}

function db_lastInsertID() {
	global $db;
	return $db->lastInsertId();
}

function get_err() {
	global $db,$kom;
	foreach ($db->errorInfo() as $e)
		if ($e!='00000') $kom[]=$e;
}

function db_query($qstr,&$ret=null) {
	global $db,$mode,$mode;
	$kom[]='Wykonuję: '.$qstr.'<br />';
	$res=null;
	try {
		$res=$db->query($qstr);
	} catch(PDOException $e) {
		echo ($e->getMessage());
	}
	if ($res) $ret=$res->fetchAll($mode);
	if (empty($ret)) return false;
	return true;
	}
$initstr="BEGIN;
CREATE TABLE users (
    uid INTEGER PRIMARY KEY NOT NULL,
    login CHAR(20) UNIQUE NOT NULL,
    haslo CHAR(5) NOT NULL,
    email CHAR(40) UNIQUE NOT NULL,
    datad INT NOT NULL
);
INSERT INTO users VALUES (NULL, 'admin', '".sha1('haslo')."', 'admin@home.net',".time().");
COMMIT;
DROP TABLE IF EXISTS klasy;
CREATE TABLE klasy(
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	klasa VARCHAR(30),
	rok_naboru INTEGER,
	rok_matury INTEGER
);

DROP TABLE IF EXISTS uczniowie;
CREATE TABLE uczniowie(
	id INTEGER PRIMARY KEY,
	imie VARCHAR(25),
	nazwisko VARCHAR(30),
	plec BOOLEAN,
	id_klasa INTEGER,
	FOREIGN KEY (id_klasa) REFERENCES klasy(id)
);

";

?>

