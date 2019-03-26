<?php
    $uczniowie=array();
class uczen{
    function __construct($id, $imie, $nazwisko, $plec, $klasa){
        $this->id=$id;
        $this->imie=$imie;
        $this->nazwisko=$nazwisko;
        $this->plec=$plec;
        $this->klasa=$klasa;
    }

    function save(){
        // Check if exists in database update/or create new
        if($this->id==-1){
            // Don't exists
            $qstr="INSERT INTO uczniowie VALUES(NULL, \"$this->imie\", \"$this->nazwisko\", $this->plec, $this->klasa)";
            db_exec($qstr);
        }else{
            
        }

    }

    function isValid(){
        return !$this->exists();
    }

    function exists(){
       $qstr="SELECT * FROM uczniowie WHERE imie=\"$this->imie\" AND 
        nazwisko=\"$this->nazwisko\" AND plec=$this->plec AND id_klasa=$this->klasa"; 
        return db_query($qstr);
    }

    function getPlec(){
        if($this->plec == 1){
            return "Mężczyzna";
        }else{
            return "Kobieta";
        }
    }


    function getKlasaName(){
        $qstr="SELECT klasa FROM klasy WHERE id=$this->klasa";
        $rawData;
        db_query($qstr, $rawData);
        return $rawData[0]['klasa'];

    }



}


?>