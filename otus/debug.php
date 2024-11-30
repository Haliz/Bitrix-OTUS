<?php

use Bitrix\Main\Diag\Debug;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->setTitle('Вывод времени в лог');

$date = date("d.m.Y H:i:s");
echo $date;
Debug::writeToFile($date, "DATE",'otus/date.txt');

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';