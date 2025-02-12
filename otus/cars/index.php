<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->setTitle('Тестирование списков');

use Bitrix\Main\Entity\Query\Join;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;

Loader::includeModule('iblock');

$iblockId = 17;
$iblockElementId = 36;

// Old API
$arFilter = [
	'IBLOCK_ID' => $iblockId,
	'ACTIVE' => 'Y'
];
$arSelect = [
	'ID',
	'NAME',
	'CODE',
	'PROPERTY_MODEL'
]; //'PROPERTY_MODEL'
$res = CIBlockElement::GetList([], $arFilter, false, [], $arSelect);
while ($arFields = $res->fetch())
{
	pr($arFields);
}
//while ($ob = $res->GetNextElement()) {
//	$arFields = $ob->GetFields();
//	pr($arFields);
//	$arProp = $ob->GetProperties();
//	pr($arProp);
//}

//$arFilter = ['IBLOCK_ID' => $iblockId];
//$arSelect = ['NAME'];
//$rsSect = CIBlockSection::GetList(['left_margin' => 'asc'], $arFilter, false, $arSelect, false);
//while ($arSect = $rsSect->fetch())
//{
//    pr($arSect);
//}

//$arElementProps = [
//    'MODEL' => 'X5',
//];
//
//$arIblockFields = [
//    'IBLOCK_ID' => $iblockId,
//    'NAME' => 'New element',
//    'PROPERTY_VALUES' => $arElementProps
//];
//$objIblockElement = new \CIBlockElement();
//$objIblockElement->Add($arIblockFields);

//Получение полей инфоблока
//$res = Bitrix\Iblock\ElementTable::getList([
//	'select'=>['*'],
//	'filter'=>['IBLOCK_ID'=>17]
//]);
//
//while($arFields = $res->fetch())
//{
//	pr($arFields);
//}
//
////Получение свойств инфоблока
//$res = Bitrix\Iblock\PropertyTable::getList([
//	'select'=>['*'],
//	'filter'=>['IBLOCK_ID'=>17]
//]);
//
//while($arFields = $res->fetch())
//{
//	pr($arFields);
//}

// ORM

//get by id
//$iblock = Iblock::wakeUp($iblockId);
//$element = $iblock->getEntityDataClass()::getByPrimary($iblockElementId)->fetchObject();
//
//// get props
//$element = $iblock->getEntityDataClass()::getByPrimary(
//	$iblockElementId,
//	['select' => ['NAME', 'MODEL']])
//->fetchObject();
//
//$name = $element->get('NAME');
//echo 'NAME: ';
//pr($name);
//
//$model = $element->get('MODEL')->getValue();
//echo 'MODEL: ';
//pr($model);

// get list
//$elements = \Bitrix\Iblock\Elements\ElementCarTable::getList([ // car - cимвольный код API инфоблока
//    'select' => ['MODEL','NAME'], // имя свойства
//])->fetchCollection();
//
//foreach ($elements as $element) {
//	pr('NAME - '.$element->getName());
//    pr('MODEL - '.$element->getModel()->getValue()); // получение значения свойства MODEL
//}

// получение через query списка элементов
$query = \Bitrix\Iblock\Elements\ElementCarTable::query() // car - cимвольный код API инфоблока
->setSelect(['NAME'])
	->addSelect('MODEL') // имя свойства
	->addSelect('ID')
	->addSelect('CITY_ID.ELEMENT.NAME');
//	->registerRuntimeField(
//		null,
//		new ReferenceField(
//			'CITY',
//			\Bitrix\Iblock\Elements\ElementCityTable::class,
//			Join::on('this.CITY_ID', 'ref.ID')));

	$elements = $query->fetchAll();
pr($query->getQuery());
foreach ($elements as $element) {
	pr($element);
}


//foreach ($elements as $key => $item) {
//    pr($item->getName().' '.$item->getModel()->getValue()); // получение значения свойства MODEL
//    // $value = $item->getModel()->getValue();
//    // if($value == 'Q7'){
//    //         $item->setModel('Q7 TEST'); // изменение значения свойства MODEL
//    //         $item->save(); // сохранение данных
//    // }
//}

echo '<pre>';
var_dump(\Bitrix\Iblock\Elements\ElementCarTable::getTableName());
echo "Hello!";
echo '</pre>';

//pr($elements);
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';