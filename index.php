<?php
ini_set('display_errors', 1);

function __autoload ($classname)
{
    include_once('core/' . $classname . '.php');
}
include_once(dirname(__FILE__) . '/functions.php');

require_once dirname(__FILE__) . '/application/core/model.php';
require_once dirname(__FILE__) . '/application/core/view.php';
require_once dirname(__FILE__) . '/application/core/controller.php';
require_once dirname(__FILE__) . '/application/core/route.php';
Route::start();
?>