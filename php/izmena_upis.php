<?php

/**
 * Created by --shortCut
 * User: Josip
 * Date: 26.06.2023.
 * Time: 15.39
 */

require 'config.php';

$podatci_nalog = new CRUD();
$podatci_nalog->table = "nalozi";
$rezultat = $podatci_nalog->select(['*'], ['*'], "SELECT * FROM nalozi where nalozi_id = " . $_POST['nalog']);


$nalog = $_POST['nalog'];
$DatumVrednost = $_POST['DatumVrednost'];
$VremeVrednost = $_POST['VremeVrednost'];
$ZaduzenNaVrednost = $_POST['ZaduzenNaVrednost'];
$Status = $_POST['Status'];

$TipNaloga = $_POST['TipNaloga'];
$Direkcija = $_POST['Direkcija'];
$Adresa = $_POST['Adresa'];
$Region = $_POST['Region'];
$Napomena_stara = $rezultat[0]['napomena'];
$Napomena_razlika_len = strlen($_POST['Napomena']) - strlen($Napomena_stara);
if($Napomena_razlika_len < 1){
    $Napomena = $Napomena_stara;
}else{
    $Napomena_nova = substr($_POST['Napomena'],-$Napomena_razlika_len);
    $Napomena = $Napomena_stara . "\n" . $_SESSION['korisnickoime'] . " - " . date('Y-m-d H:i:s') . " : ". $Napomena_nova; 
}

$Datum_izmene = date("Y/m/d");
$Datum_zavrsetka = date("Y/m/d");

$podatci_upis = new CRUD();
$podatci_upis->table = "nalozi";

if ($Status < 4) {
    $podatci_upis->update(['datum_zakazan' => $DatumVrednost, 'vreme_zakazan' => $VremeVrednost, 'kome_zaduzen' => $ZaduzenNaVrednost, 'status_id' => $Status, 'tip_naloga' => $TipNaloga, 'direkcija' => $Direkcija, 'adresa' => $Adresa, 'region' => $Region, 'napomena' => $Napomena, 'datum_izmene' => $Datum_izmene], ['nalozi_id' => $nalog]);
} else {
    $podatci_upis->update(['datum_zakazan' => $DatumVrednost, 'vreme_zakazan' => $VremeVrednost, 'kome_zaduzen' => $ZaduzenNaVrednost, 'status_id' => $Status, 'tip_naloga' => $TipNaloga, 'direkcija' => $Direkcija, 'adresa' => $Adresa, 'region' => $Region, 'napomena' => $Napomena, 'datum_izmene' => $Datum_izmene, 'datum_zavrsen' => $Datum_zavrsetka], ['nalozi_id' => $nalog]);
}

$log_upis = new CRUD();
$log_upis->table = "log_nalozi";



$log_upis->insert(['id_korisnika'=>$_SESSION['korisnickoime'],'id_naloga'=> $_POST['nalog'],'Opis'=> $opis]);