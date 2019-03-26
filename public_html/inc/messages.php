<?php
    $messages=array();
    class message{
        function __construct($id, $idNadawcy, $idOdbiorcy, $tekst){
            $this->id=$id;
            $this->idNadawcy=$idNadawcy;
            $this->idOdbiorcy=$idOdbiorcy;
            $this->tekst=$tekst;
        }

        function save(){
         $qstr="INSERT INTO messages VALUES (NULL, $this->idNadawcy, $this->idOdbiorcy, \"$this->tekst\")";

         db_exec($qstr);

        }









    }


?>