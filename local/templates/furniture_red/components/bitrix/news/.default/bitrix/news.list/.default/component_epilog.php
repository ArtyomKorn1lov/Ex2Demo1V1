<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if ($arResult["SPECIALDATE_PROPERTY"]) {
	$APPLICATION->SetPageProperty("specialdate", $arResult["SPECIALDATE_PROPERTY"]);
}