<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$cp = $this->__component;

if ($arParams["SET_PROPERTY_SPECIALDATE"] === "Y" && !empty($arResult["ITEMS"]) && $arResult["ITEMS"][0]["DISPLAY_ACTIVE_FROM"]) {
	$arResult["SPECIALDATE_PROPERTY"] = $arResult["ITEMS"][0]["DISPLAY_ACTIVE_FROM"];
	$cp->SetResultCacheKeys(["SPECIALDATE_PROPERTY"]);
}