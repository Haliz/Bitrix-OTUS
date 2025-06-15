<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

///echo 'Hello1111';

use Bitrix\Main\Loader;
use Bitrix\Iblock\Iblock;

Loader::includeModule('iblock');

//Infoblock type 1
//$arFilter = ['IBLOCK_ID' => 19, 'ACTIVE' => 'Y'];
//$arSelect = ['ID', 'NAME', "PROPERTY_*"]; //'PROPERTY_MODEL'   'ID', 'NAME', 'CODE', "PROPERTY_*"
//$res = CIBlockElement::GetList([], $arFilter, false, [], $arSelect);
////while($arFields = $res->fetch()){
////    pr($arFields);
////}
//while ($ob = $res->GetNextElement()) {
//	$arFields = $ob->GetFields();
//	pr($arFields);
//	$arProp = $ob->GetProperties();
//	pr($arProp);
//}
$elements = Bitrix\Iblock\Elements\ElementPrm1Table::query();     //GetList(['select'=>['ID', 'NAME', 'PROP_1_STR']]);
$elements = $elements
	->setSelect(['ID', 'NAME', 'PROP_1_STR']);
pr($elements->getQuery());
//while($arFields = $elements->fetch()){
//    pr($arFields);
//}

//Infoblock type 2
//$arFilter = ['IBLOCK_ID' => 20, 'ACTIVE' => 'Y'];
//$arSelect = ['ID', 'NAME', "PROPERTY_*"]; //'PROPERTY_MODEL'   'ID', 'NAME', 'CODE', "PROPERTY_*"
//$res = CIBlockElement::GetList([], $arFilter, false, [], $arSelect);
////while($arFields = $res->fetch()){
////    pr($arFields);
////}
//while ($ob = $res->GetNextElement()) {
//	$arFields = $ob->GetFields();
//	pr($arFields);
//	$arProp = $ob->GetProperties();
//	pr($arProp);
//}
$elements = Bitrix\Iblock\Elements\ElementInfo2Table::query();   //GetList(['select'=>['ID', 'NAME', 'PROP_2_STR']]);
$elements = $elements
	->setSelect(['ID', 'NAME', 'PROP_2_STR']);
pr($elements->getQuery());
//while($arFields = $elements->fetch())
//{
//	pr($arFields);
//}
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';