<?php

function getUzytkownikByUId($uid){
    $qstr="SELECT * FROM users WHERE uid=$uid";
    $rawData;
    db_query($qstr, $rawData);

    $user=$rawData[0];
    $userObj=new uzytkownik(user['uid'], user['login'], user['email']);

    return userObj;
    

}

class uzytkownik{
    function __construct($uid, $login, $email){
        $this->uid=$uid;
        $this->login=$login;
        $this->email=$email;
    }
}

?>
