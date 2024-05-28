<?php

//archivo que va enviar a llamar funciones y la bd

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectarnos a la bd

$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);