<?php
    /**
    * 
    */
    require_once('function.php');

    $controllerAllow = array('index', 'test');
    $methodAllow = array('index', 'test', 'show');

    $controller = in_array($_GET['controller'], $controllerAllow)?addslashes($_GET['controller']):'index';
    $method = in_array($_GET['method'], $methodAllow)?addslashes($_GET['method']):'index';

    C($controller, $method);
    // echo '<table border=1><tr><td>'.$controller.'<td>'.$method.'</table>';
?>