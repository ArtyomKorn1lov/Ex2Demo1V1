<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"GROUPS" => [],
	"PARAMETERS" => array(
		"CATALOG_IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
		"NEWS_IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_NEWS_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
		"CATALOG_SECTION_PROPERTY_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_SEC_PROP_CODE"),
			"TYPE" => "STRING",
		),
		"CACHE_TIME" => ["DEFAULT" => 36000000],
	),
);