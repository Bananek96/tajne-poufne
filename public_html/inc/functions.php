<?php
$kom = [];  // tablica komunikatów
$pages = array(
    'witam'=>'Aplikacja w PHP',
    'sqlcmd'=>'SQL',
    'csssel'=>'Selektory CSS',
    'formularz'=>'Formularz',
    'dodaj-klase'=>'Dodaj klasę',
    'lista-klas'=>'Lista klas',
    'dodaj-ucznia'=>'Dodaj ucznia',
    'lista-uczniow'=>'Lista uczniów'
    //'login'=>'Logowanie'
);

function get_page_title($id) {
    global $pages;
    if (array_key_exists($id, $pages))
        echo $pages[$id];
    else
        echo 'Aplikacja w PHP';
}

function get_kom() {
    global $kom;
    foreach ($kom as $k)
        echo '<p class="lead">'.$k.'</p>';
    $kom=[];
}

function get_page_content($id) {
    global $pages, $kom;
    if (file_exists($id.'.html'))
        include($id.'.html');
    else
        $kom[]='Brak strony: '.$id;
}

function get_menu($id) {
    global $pages;
    foreach ($pages as $klucz => $wartosc) {
        echo '
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="?id='.$klucz.'">'.$wartosc.'</a>
        </li>';
    }
    global $user;
    if($user->uid){
        echo '<li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="?id=wyloguj">Wyloguj</a>
    </li>';
    echo '<li class="nav-item">
    <a class="nav-link js-scroll-trigger" href="?id=wyslij">Wyślij</a>
    </li>';
    echo '<li class="nav-item">
    <a class="nav-link js-scroll-trigger" href="?id=odbierz">Odbierz</a>
    </li>';

    }else{
        echo '<li class="nav-item">
        <a class="nav-link js-scroll-trigger" href="?id=login">Zaloguj</a>
    </li>';
    }

}

function clrtxt(&$el, $maxdl=30) {
    if (is_array($el)) {
        return array_map('clrtxt', $el);
    } else {
        $el = trim($el);
        $el = substr($el, 0, $maxdl);
        if (get_magic_quotes_gpc()) $el=stripslashes($el);
        $el=htmlspecialchars($el, ENT_QUOTES);
        return $el;
    }
}

function rescape($str) {
    if (!($isa=is_array($str))) $str=array($str);
    foreach ($str as $k => $w) $str[$k] = get_magic_quotes_gpc() ? stripslashes($w) : $w;
    if (!$isa) return $str[0]; else return $str;
}

function checkIfValidYears($roknaboru, $rokmatury){
    return is_numeric($roknaboru) && is_numeric($rokmatury);
 }


function loadKlasy(){
    global $klasy;
    $qstr='SELECT * FROM klasy';

    $rawData;
    db_query($qstr, $rawData);
    foreach($rawData as $klasa){
        
        $klasaObj = new klasa($klasa['id'],$klasa['klasa'], $klasa['rok_naboru'], $klasa['rok_matury']);
        array_push($klasy, $klasaObj);
    }
  
}

function loadUczniowie(){
    global $uczniowie;
    $qstr='SELECT * FROM uczniowie';
    
    $rawData;
    db_query($qstr, $rawData);
    foreach($rawData as $uczen){
        $uczenObj=new uczen($uczen['id'], $uczen['imie'], $uczen['nazwisko'], $uczen['plec'], $uczen['id_klasa']);
        array_push($uczniowie, $uczenObj);
        
    }

}



function loadUsers(){
    global $users;
    $qstr='SELECT * FROM users';
    
    $rawData;
    db_query($qstr, $rawData);

    foreach($rawData as $user){
        $userObj=new uzytkownik($user['uid'], $user['login'], $user['email']);
        array_push($users, $userObj);
    }
    print_r($users);

}


function loadMessages(){
    global $user;
    global $messages;
    $qstr= "SELECT * FROM messages WHERE id_odbiorcy=$user->uid";
    $rawData;

    db_query($qstr, $rawData);
    foreach($rawData as $message){
        $messageObj=new message($message['id'],$message['id_nadawcy'], $message['id_odbiorcy'], $message['wiadomosc']);
        array_push($messages, $messageObj);
    }




}






?>
