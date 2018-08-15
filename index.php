<?php
ini_set('display_errors', 1);

foreach(array_diff(scandir(dirname(__FILE__) . '/core1/'), array('.', '..')) as $file)
	require_once(dirname(__FILE__) . '/core1/' . $file);

require_once dirname(__FILE__) . '/application/core/model.php';
require_once dirname(__FILE__) . '/application/core/view.php';
require_once dirname(__FILE__) . '/application/core/controller.php';
require_once dirname(__FILE__) . '/application/core/route.php';
Route::start();
?>