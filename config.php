<?php

const DEBUG = false;

error_reporting(E_ALL);

ini_set('display_errors', DEBUG);
// ini_set("log_errors", !DEBUG); // Should I really log errors for this?

const WEBSITE_HTTP = "http://localhost/library/";

const COVERS_FOLDER = WEBSITE_HTTP . "resources/covers/"; 

const COVERS_FOLDER_LOCAL = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'covers' . DIRECTORY_SEPARATOR;

const TABLE_DEFAULTS = [
		'startPage' => 0,
		'per_page' => 20,
		'order_by' => 'published',
		'order' => 'DESC',
		'covers_folder' => '/../resources/covers/',
];