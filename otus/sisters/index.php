<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->setTitle('Медсестры');

use Bitrix\Main\Entity\Query\Join;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;

Loader::includeModule('iblock');

echo '<pre>';
echo "Hello Sisters!";
echo '</pre>';
// Получение через объект
$sisters = Bitrix\Iblock\Elements\ElementSistersTable::getList([

	'select' => [
		'ID',
		'NAME',
		'FAMILI',
		'ROOM.ELEMENT',
		'PROCEDURES.ELEMENT'
	],
	'filter' => ['ID' => 60]
])->fetchCollection();

foreach ($sisters as $sister)
{
	pr($sister->get('ID'));
	pr($sister->get('NAME'));
	pr($sister->get('FAMILI')->getValue());
	pr($sister->getRoom()->getElement()->getName());
	foreach ($sister->get('PROCEDURES')->getAll() as $prItem)
	{
		pr($prItem->getElement()->getName());
	}
}

////Получение через массив
//
//$sisters = Bitrix\Iblock\Elements\ElementSistersTable::getList([
//
//	'select' => [
//		'ID',
//		'NAME',
//		'FAMILI',
////		'ROOM.ELEMENT',
//		'PROCEDURES.ELEMENT'  // Для множественного элемента выбирается только первое значение.
//	],
//	'filter' => ['ID' => 60]
//])->fetch();
//pr($sisters);
//pr($sisters['IBLOCK_ELEMENTS_ELEMENT_SISTERS_FAMILI_VALUE']);
//pr($sisters['IBLOCK_ELEMENTS_ELEMENT_SISTERS_ROOM_ELEMENT_NAME']);

// Получение посредством запроса.

$sisters = Bitrix\Iblock\Elements\ElementSistersTable::query();
$quer = $sisters -> setSelect(['ID',
	'NAME',
	'FAMILI',
	'ROOM.ELEMENT',
	'PROCEDURES.ELEMENT'])->exec()->fetchCollection(); //exec()-> можно не писать.

foreach ($quer as $sister)
{
	pr($sister->get('ID'));
	pr($sister->get('NAME'));
	pr($sister->get('FAMILI')->getValue());
	pr($sister->getRoom()->getElement()->getName());
	foreach ($sister->get('PROCEDURES')->getAll() as $prItem)
	{
		pr($prItem->getElement()->getName());
	}
}

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';