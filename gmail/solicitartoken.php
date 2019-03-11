<?php

session_start();
require_once '../classes/vendor/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('correoDWES');
$cliente->setClientId('523379648859-a3tmoojad9afi0jbhd32t55ths1vsfnc.apps.googleusercontent.com');
$cliente->setClientSecret('vI0rIy__aBSw_DGYHbA91Bkd');
$cliente->setRedirectUri('https://dwse-scoprions.c9users.io/proyecto/gmail/obtenercredenciales.php');
$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessType('offline');
if (!$cliente->getAccessToken()) {
    $auth = $cliente->createAuthUrl();
    header("Location: $auth");
}