<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

/** Подготовка параметров компонента */
if (!isset($arParams["CATALOG_IBLOCK_ID"])) {
	$arParams["CATALOG_IBLOCK_ID"] = 2;
}
if (!isset($arParams["NEWS_IBLOCK_ID"])) {
	$arParams["NEWS_IBLOCK_ID"] = 1;
}
if (!isset($arParams["CATALOG_SECTION_PROPERTY_CODE"])) {
	$arParams["CATALOG_SECTION_PROPERTY_CODE"] = "UF_NEWS_LINK";
}
if (!isset($arParams["CACHE_TIME"])) {
    $arParams["CACHE_TIME"] = 36000000;
}

/** Выполнение компонента */
global $APPLICATION;
if($this->StartResultCache()) {
	/** Получение новостей */
	$arNews = [];
	$arNewsIds = [];
	$rsElements = CIBlockElement::GetList(
		[], 
		["IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"], "ACTIVE" => "Y"], 
		false, 
		false, 
		["ID", "NAME", "DATE_ACTIVE_FROM"]
	);
	while ($arItem = $rsElements->Fetch()) {
		$arNews[] = $arItem;
		$arNewsIds[] = $arItem["ID"];
	}
	/** Получение разделов каталога */
	$arSections = [];
	$rsElements = CIBlockSection::GetList(
		[], 
		["IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"], $arParams["CATALOG_SECTION_PROPERTY_CODE"] => $arNewsIds, "ACTIVE" => "Y"], 
		false, 
		["ID", "NAME", $arParams["CATALOG_SECTION_PROPERTY_CODE"]], 
		false
	);
	while ($arItem = $rsElements->Fetch()) {
		$arSections[] = $arItem;
	}
	foreach ($arNews as $key => $itemNews) {
		foreach ($arSections as $itemSections) {
			if (in_array($itemNews["ID"], $itemSections[$arParams["CATALOG_SECTION_PROPERTY_CODE"]])) {
				$arNews[$key]["SECTIONS"]["IDS"][] = $itemSections["ID"];
				$arNews[$key]["SECTIONS"]["NAMES"][] = $itemSections["NAME"];
			}
		}
	}
	/** Получение элементов каталога по разделам */
	$arResult["PRODUCT_COUNT"] = 0;
	$arPrices = [];
	foreach ($arNews as $key => $arItem) {
		$rsElements = CIBlockElement::GetList(
			[],
			["IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"], "SECTION_ID" => $arItem["SECTIONS"]["IDS"], "ACTIVE" => "Y"],
			false, 
			false, 
			["NAME", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER", "PROPERTY_PRICE"]
		);
		while ($item = $rsElements->Fetch()) {
			$arNews[$key]["PRODUCTS"][] = $item;
			$arPrices[] = $item["PROPERTY_PRICE_VALUE"];
			$arResult["PRODUCT_COUNT"]++;
		}
	}
	/** Получение максимальной и минимальной цены для последущего отображения данных в другом месте */
	if (!empty($arPrices)) {
		sort($arPrices);
		$arResult["MIN_PRICE"] = $arPrices[0];
		rsort($arPrices);
		$arResult["MAX_PRICE"] = $arPrices[0];
		$arResult["ITEMS"] = $arNews;
	}
	$this->SetResultCacheKeys(["PRODUCT_COUNT", "MAX_PRICE", "MIN_PRICE"]);
	$this->IncludeComponentTemplate();
}
$APPLICATION->SetTitle(GetMessage("SIMPLECOMP_EXAM2_TITLE_PAGE").$arResult["PRODUCT_COUNT"]);