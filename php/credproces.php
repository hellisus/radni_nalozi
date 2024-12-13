<?php
require 'config.php';


$korisnici = new CRUD();
$korisnici->table = "korisnici";

$hp = hash256($_POST['pwd']);

$rezultat = $korisnici->select(['*'], ['korisnickoime' => $_POST['uid'], 'hash' => $hp]);

if (count($rezultat) == 0) {
	$_SESSION['poruka'] = "Pogrešno korisničko ime ili lozinka!";
	if (isset($_SESSION['poruka'])) {
		header("location:error.php");
	};
} else {
	$_SESSION['Ime'] = $rezultat[0]['ime'];
	$_SESSION['Prezime'] = $rezultat[0]['prezime'];
	$_SESSION['korisnickoime'] = $rezultat[0]['korisnickoime'];
	$_SESSION['id'] = $rezultat[0]['id'];
	$_SESSION['logged_in'] = true;
	$_SESSION['tip'] = $rezultat[0]['tip'];
	$_SESSION['ustanova'] = $rezultat[0]['ustanova'];

	$korisnici->update(['aktivan' => 1, 'vremelogovanja' => date("Y-m-d H:i:s")], ['korisnickoime' => $_SESSION['korisnickoime']]);
	$korisnici->table = "korisnici_log";
	$korisnici->insert(['korisnik' => $rezultat[0]['korisnickoime'], 'vreme_prijave_na_sistem' => date("Y-m-d H:i:s")]);

	if (isset($_SESSION['Ime'])) {
		header("location:../php/glavni.php");
	};
}
