<?php

require  'config.php';

//$data = new CRUD();
//$data->table = "pacijenti";
//$rbr = $data->select(['*'], ['*'], "SELECT * FROM `pacijenti` WHERE jmbg = 2908968786066 ORDER BY id");

//$poslednji_unos = ($rbr[count($rbr) - 1]); */

//print_r($rbr[count($rbr) - 1]);

//define('SALT', 'Icxchll3344');

//function hash256($string_za_hesh){
//return hash('sha256', $string_za_hesh . SALT);
//}

$hp = hash256('tanjar9964');

print_r($hp);

//$pacijenti = new CRUD();
//$pacijenti->table = "pacijenti";
//$rezultat = $pacijenti->select(['*'], ['*'], "SELECT * FROM pacijenti WHERE jmbg = '1704980000000' ORDER BY datum_ldct");
//print_r($rezultat[0]['novi_p']) ;
//$koji_je = count($rezultat)+1;

////if (count($rezultat) === 1 && $rezultat[0]['novi_p'] == 1) {
//   echo "Prvi if izvršen - ako je prvi";
//    echo $rezultat[$koji_je-2]['datum_ldct'];
//};

//if ($rezultat[0]['novi_p'] != 1) {
//    echo "Drugi if izvršen - ako je n-ti pregled ";
//    echo $rezultat[$koji_je-2]['datum_ldct'];
//}


//echo 'Current PHP version: ' . phpversion();
