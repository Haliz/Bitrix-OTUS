<?php
define('DEBUG_FILE_NAME', $_SERVER["DOCUMENT_ROOT"] .'/logs/'.date("Y-m-d").'.log');
//define('DEBUG_FILE_NAME', $_SERVER["DOCUMENT_ROOT"] .'/logs/otus_exceptions.log');

if (file_exists(__DIR__ . '/classes/autoload.php')) {
	require_once __DIR__ . '/classes/autoload.php';
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}
require_once (__DIR__.'/functions.php');
Bitrix\Main\UI\Extension::load(['popup', 'crm.currency', 'timeman.custom']);