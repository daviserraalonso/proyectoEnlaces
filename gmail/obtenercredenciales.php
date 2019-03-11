<?php
session_start();
require_once '../classes/vendor/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('correoDWES');
$cliente->setClientId('523379648859-a3tmoojad9afi0jbhd32t55ths1vsfnc.apps.googleusercontent.com');
$cliente->setClientSecret('vI0rIy__aBSw_DGYHbA91Bkd');
$cliente->setRedirectUri('https://dwse-scorpions.c9users.io/proyecto/gmail/obtenercredenciales.php');
$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessType('offline');
if (isset($_GET['code'])) {
$cliente->authenticate($_GET['code']);
$_SESSION['token'] = $cliente->getAccessToken();
$archivo = "token.conf";
$fh = fopen($archivo, 'w') or die("error");
fwrite($fh, json_encode($cliente->getAccessToken()));
fclose($fh);
header("Location: finalizartoken.php?code=" . $_GET['code']);
}