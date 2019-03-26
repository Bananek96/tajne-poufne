<?php
	
	$klasy=array();
	// function dodajKlase($nazwa, $roknaboru, $rokmatury){
		

	// 	$klasa=new klasa($nazwa, $roknaboru, $rokmatury);
	// 	//array_push($klasy, $klasa);
	// 	//$klasa->wyswietlNazwe();

	// }


	// function checkIfKlasaExists(&$nazwa, &$roknaboru, &$rokmatury){
	// 	$qstr='SELECT * FROM klasy WHERE klasa=\''.$nazwa.
	// 	'\' AND rok_naboru='.$roknaboru.' AND rok_matury='.$rokmatury;

	// 	return db_query($qstr);
	// }


	// function isValidKlasa($nazwa, $roknaboru, $rokmatury){
	// 	if(checkIfValidYears($roknaboru, $rokmatury) && !checkIfKlasaExists($nazwa, $roknaboru, $rokmatury)){
	// 		return true;
	// 	}		
	// 	return false;
	// }

	
	class klasa{
		function __construct($id, $nazwa, $roknaboru, $rokmatury){
			$this->id=$id;
			$this->nazwa=$nazwa;
			$this->roknaboru=$roknaboru;
			$this->rokmatury=$rokmatury;
	
		}


		function save(){
			if(!$this->exists()){
				// Create new
				$qstr='INSERT INTO klasy VALUES(NULL, \''.$this->nazwa.'\','.$this->roknaboru.
						','.$this->rokmatury.')';
				db_exec($qstr);
			}else{
				// Update existing
				$qstr='UPDATE klasy SET nazwa=\''.$this->nazwa.'\', rok_naboru='.$this->roknaboru.', rok_matury='.$this->rok_matury.
				' WHERE id='.$this->id;
			}
			
		}

		function isValid(){
			if(checkIfValidYears($this->roknaboru, $this->rokmatury) && !$this->exists()){
				return true;
			}		
			return false;
		}

		function exists(){
			$qstr='SELECT * FROM klasy WHERE klasa=\''.$this->nazwa.
			'\' AND rok_naboru='.$this->roknaboru.' AND rok_matury='.$this->rokmatury;
			return db_query($qstr);
		}


		

	}






?>