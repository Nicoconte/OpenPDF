<?php
spl_autoload_register(function($class) {
    return include $_SERVER['DOCUMENT_ROOT'] . "/OpenPDF/Source/Classes/" . $class . ".php";
});
?>