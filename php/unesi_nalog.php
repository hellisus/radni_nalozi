<?php
require_once 'config.php';


$korisnici = new CRUD();
$korisnici->table = "korisnici";

$rezultat = $korisnici->select(['*'], ['korisnickoime' => $_POST['korisnickoime']]);

if (count($rezultat) == 0){

$hovano = hash256($_POST['lozinka']);

$korisnici->insert(['ime' => $_POST['ime'],
'prezime' => $_POST['prezime'],
'korisnickoime' => $_POST['korisnickoime'],
'lozinka' => $_POST['lozinka'],
'hash' => $hovano,
'tip' => $_POST['tip'],
'aktivan' => 1
] );

}