<?php

// pamti 8 sati
ini_set('session.gc_maxlifetime', 28800);

// pamti 8 sati
session_set_cookie_params(28800);
date_default_timezone_set('Europe/Belgrade');
session_start();

//Inkludovi
require 'CRUD.php';

//Definicije
define('SALT', 'Icxchll3344');
define('db_name_PUBLIC', 'sbb22594_unisell');
define('db_host_PUBLIC', 'db21.cpanelhosting.rs');
define('db_user_PUBLIC', 'sbb22594_sbb22594');
define('db_pword_PUBLIC', 'Icxchll3344');

//Funkcije
function hash256($string_za_hesh)
{
	return hash('sha256', $string_za_hesh . SALT);
}

