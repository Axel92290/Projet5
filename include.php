<?php

session_start();

include_once('db/connexiondb.php');
include_once('class/registration.php');
include_once('class/connexion.php');

//Déclaration des classes sous formes de variables

$_registration = new registration;
$_Connexion = new Connexion;
