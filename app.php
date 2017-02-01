<?php

use Controllers\Controller;

session_start();
require_once 'config.php';
require_once 'autoload.php';

if (isset($_GET['route'])){
	$route = $_GET['route'];
	$args = $_GET;
} else if (isset($_POST['route'])) {
	$route = $_POST['route'];
	$args = $_POST;
} else {
	$route = 'index';
	$args = null;
}

Controller::$route($args);