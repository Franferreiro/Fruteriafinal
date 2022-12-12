<?php
function autoload($clase){
$url=str_replace("\\","/",$clase.".php");
require_once($url);
}
spl_autoload_register('autoload');
?>