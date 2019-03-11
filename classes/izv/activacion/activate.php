<?php

    require '../classes/autoload.php';
    require '../classes/vendor/autoload.php';
    
    use izv\data\Usuario;
    use izv\tools\Reader;
    use izv\app\App;
    use izv\tools\Alert;
    use izv\tools\Tools;
    use izv\database\Database;
    use izv\managedata\ManagerUsuario;

    
    $resultado = 0;

    $db = new Database();
    $manager = new ManagerUsuario($db);
    $usuario = $manager->get($id);

    if($usuario !== null && !$usuario->getActivo()) {
        $usuario->setActivo(true);
        if($manager->edit($usuario)) {
            $resultado  = 1;
        }
    }

    $url = '../index.php?op=' . Alert::ACTIVATE . '&resultado=' . $resultado;
    echo $url;
    header('Location: ' . $url);
