<?php

/**
 * Created by Visual studio.
 * User: Josip
 * Date: 20.03.2023
 * Time: 18:16
 */


require 'CRUD.php';
require 'EmailMessage.php';

$nalozi = new CRUD();
$nalozi->table = "nalozi";

$mbox = imap_open("{mail.srnalozi.com:993/imap/ssl/novalidate-cert}INBOX", "nalozi_glavni@srnalozi.com", "Icxchll3344!!*");
$numMessages = imap_num_msg($mbox);
if ($numMessages != 0) {
    echo 'ima poruka ' . $numMessages . "<br/>";  // Broj poruka u inboksu

    function get_between_data($input_str, $start, $end)
    {
        $pos_string = stripos($input_str, $start);
        $substr_data = substr($input_str, $pos_string);
        $string_two = substr($substr_data, strlen($start));
        $second_pos = stripos($string_two, $end);
        $string_three = substr($string_two, 0, $second_pos);
        // remove whitespaces from result
        $result_unit = trim($string_three);
        // return result_unit
        return $result_unit;
    }

    for ($msgno = 1; $msgno <= $numMessages; $msgno++) {
        $headers = imap_headerinfo($mbox, $msgno);  //čitaj heder poruke
        if ($headers->Unseen == 'U') {

            $naslov_poruke = $headers->subject;

            // NS NALOZI - Kapija

            preg_match('/## [A-Z]{2}\d{6}/', $naslov_poruke, $matches);
            if (count($matches) > 0) {

                // Nađi broj naloga
                $šta_je_našao = trim($matches[0]);
                $br_naloga = substr($šta_je_našao, -8);;
                echo $br_naloga . "<br/>";

                $emailMessage = new EmailMessage($mbox, $msgno);
                $emailMessage->getAttachments = false;
                $emailMessage->fetch();
                $subject = $emailMessage->bodyHTML;

                echo "<hr>";
                $html_markap = array('</td>', '<td>', '<tr>', '</tr>', '<br>','</tbody>','</table>', '</div>', '<div>');
                $html_markap_r = array('', '', '', '', '', '', '', '', '');
                $subject = str_replace($html_markap, $html_markap_r, $subject);
                echo $subject;
                echo "<hr>";
                // Nađi ko šalje
                //$ko_salje = trim(get_between_data($subject, 'Од:', 'Date:'));
                $ko_salje_arr = json_decode(json_encode($headers->from[0]), true);
                $ko_salje = $ko_salje_arr['personal'];
                echo $ko_salje;

                // Nađi kad je poslato
                $kad_poslato = trim(get_between_data($subject, 'Date:', 'Subject:'));
                echo $kad_poslato . "<br/>";

                // Nađi tip naloga
                $tip_naloga = trim(get_between_data($subject, 'Tip Naloga:', 'Direkcija:'));
                if ($tip_naloga == "") {
                    $tip_naloga = "NEPOZNATO";
                }
                echo $tip_naloga . "<br/>";

                // Nađi direkciju
                $direkcija = trim(get_between_data($subject, 'Direkcija:', 'Adresa lokacije:'));
                if ($direkcija == "") {
                    $direkcija = "NEPOZNATO";
                }
                echo $direkcija . "<br/>";

                // Nađi Adresu lokacije
                $adresa = trim(get_between_data($subject, 'Adresa lokacije:', 'Region:'));
                echo $adresa . "<br/>";

                // Nađi region
                $region = strtoupper(trim(get_between_data($subject, 'Region:', 'NAPOMENA:')));
                if ($region == "/") {
                    $region = "NEPOZNATO";
                } elseif ($region == "NOVI SAD - ISTOK") {
                    $region = "ISTOK";
                }
                echo $region . "<br/>";

                // Nađi napomenu
                $napomena = trim(get_between_data($subject, 'Opis reklamacije:', 'Opis projekta:'));
                $napomena2 = trim(get_between_data($subject, 'Opis projekta:', 'Nalog ID:'));
                if($napomena != $napomena2){
                    if($napomena2 != '/'){
                        $napomena = $napomena . " " . $napomena2;
                    }
                }

                echo $napomena . "<br/>";

                // Nađi ko je kreirao
                $kreator = trim(get_between_data($subject, 'Nalog kreirao/la:', 'Datum naloga:'));
                echo $kreator . "<br/>";

                // Nađi KAD je kreirao
                $vreme = trim(get_between_data($subject, 'Datum naloga:', '#SBB######ACT############MAIL#'));
                if (strpos($vreme, "/")) {
                    $arr_razbijeno_vreme = explode("/", $vreme);
                    if (strlen(trim($arr_razbijeno_vreme[1])) < 2) {
                        $arr_razbijeno_vreme[1] = "0" . trim($arr_razbijeno_vreme[1]);
                    }
                    if (strlen(trim($arr_razbijeno_vreme[0])) < 2) {
                        $arr_razbijeno_vreme[0] = "0" . trim($arr_razbijeno_vreme[0]);
                    }
                    $vreme = $arr_razbijeno_vreme[1] . "." . $arr_razbijeno_vreme[0] . ".20" . $arr_razbijeno_vreme[2];
                }
                echo $vreme . "<br/>";

                $ima_ga = $nalozi->select(['*'], ['br_naloga' => $br_naloga]);

                if (count($ima_ga) == 0) {
                    $nalozi->insert([
                        'br_naloga' => $br_naloga,
                        'tip_naloga' => $tip_naloga,
                        'direkcija' => $direkcija,
                        'adresa' => $adresa,
                        'region' => $region,
                        'napomena' => $napomena,
                        'mejl_slanja' => $ko_salje,
                        'vreme_prijema' => date("Y-m-d H:i:s"),
                        'kad_kreiran' => $vreme,
                        'ko_kreira' => $kreator,
                        'status_id' => 1
                    ]);
                }
            }

            // Kragujevac NALOZI - Kapija

            preg_match('/[A-Z]{2}\d{6}/', $naslov_poruke, $matches);
            if (count($matches) > 0) {

                // Nađi broj naloga
                $šta_je_našao = trim($matches[0]);
                $br_naloga = substr($šta_je_našao, -8);
                echo $br_naloga . "<br/>";

                $emailMessage = new EmailMessage($mbox, $msgno);
                $emailMessage->getAttachments = false;
                $emailMessage->fetch();
                $subject = $emailMessage->bodyHTML;

                echo "<hr>";
                $html_markap = array('</td>', '<td>', '<tr>', '</tr>', '<br>','</tbody>','</table>', '</div>', '<div>');
                $html_markap_r = array('', '', '', '', '', '', '', '', '');
                $subject = str_replace($html_markap, $html_markap_r, $subject);
                echo $subject;
                echo "<hr>";

                // Nađi ko šalje
                //$ko_salje = trim(get_between_data($subject, 'Од:', 'Date:'));
                $ko_salje_arr = json_decode(json_encode($headers->from[0]), true);
                $ko_salje = $ko_salje_arr['personal'];
                echo $ko_salje . "<br/>";

                // Nađi kad je poslato
                $kad_poslato = trim(get_between_data($subject, 'Date:', 'Subject:'));
                echo $kad_poslato . "<br/>";

                // Nađi tip naloga

                $tip_naloga =  trim(trim(get_between_data($subject, 'Tip naloga:', 'CRM nalog:'), '.'));
                if ($tip_naloga == "") {
                    $tip_naloga = "NEPOZNATO";
                }
                echo $tip_naloga . "<br/>";

                // Nađi direkciju
                $direkcija = trim(trim(get_between_data($subject, 'Grad:', 'Region:'), '.'));
                if ($direkcija == "") {
                    $direkcija = "NEPOZNATO";
                }
                echo $direkcija . "<br/>";

                // Nađi Adresu lokacije
                $adresa = trim(trim(get_between_data($subject, 'Adresa kupca:', 'Grad:'), '.'));
                echo $adresa . "<br/>";

                // Nađi region
                $region = trim(trim(get_between_data($subject, 'Region:', 'Kontakt osoba:'), '.'));
                if ($region == "/") {
                    $region = "NEPOZNATO";
                }
                echo $region . "<br/>";

                // Nađi napomenu
                $napomena = trim(trim(get_between_data($subject, 'Opis reklamacije:', '=========================')));
                $napomena2 = trim(trim(get_between_data($subject, 'Opis projekta:', '=========================')));
                if($napomena != $napomena2){
                    $napomena = $napomena . " " . $napomena2;
                }
                echo $napomena . "<br/>";

                // Nađi ko je kreirao
                //$kreator = trim(get_between_data($subject, 'Nalog kreirao/la:', '========================='));
                $kreator = $ko_salje;
                echo $kreator . "<br/>";

                // Nađi KAD je kreirao
                $vreme = trim(get_between_data($subject, 'Vreme kreiranja:', '========================='), '.');
                if (strpos($vreme, "/")) {
                    $arr_razbijeno_vreme = explode("/", $vreme);
                    if (strlen(trim($arr_razbijeno_vreme[1])) < 2) {
                        $arr_razbijeno_vreme[1] = "0" . trim($arr_razbijeno_vreme[1]);
                    }
                    if (strlen(trim($arr_razbijeno_vreme[0])) < 2) {
                        $arr_razbijeno_vreme[0] = "0" . trim($arr_razbijeno_vreme[0]);
                    }
                    $vreme = $arr_razbijeno_vreme[1] . "." . $arr_razbijeno_vreme[0] . ".20" . $arr_razbijeno_vreme[2];
                }

                echo $vreme . "<br/>";

                $ima_ga = $nalozi->select(['*'], ['br_naloga' => $br_naloga]);

                if (count($ima_ga) == 0) {
                    $nalozi->insert([
                        'br_naloga' => $br_naloga,
                        'tip_naloga' => $tip_naloga,
                        'direkcija' => $direkcija,
                        'adresa' => $adresa,
                        'region' => "KRAGUJEVAC",
                        'napomena' => $napomena,
                        'mejl_slanja' => $ko_salje,
                        'vreme_prijema' => date("Y-m-d H:i:s"),
                        'kad_kreiran' => $vreme,
                        'ko_kreira' => $kreator,
                        'status_id' => 1
                    ]);
                }
            }
        }
    }
} else {
    echo "Prazan inbox";
}
imap_close($mbox);
