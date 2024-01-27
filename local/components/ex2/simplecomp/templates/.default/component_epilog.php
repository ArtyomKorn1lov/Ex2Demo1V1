<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */

global $APPLICATION;

if (!($arResult["MIN_PRICE"] && $arResult["MAX_PRICE"])) {
	return;
}
ob_start();
?>
<div style="color:red; margin: 34px 15px 35px 15px">--- <?=$arResult["MIN_PRICE"]?> <?=$arResult["MAX_PRICE"]?> ---</div>
<?php
$html = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent("price_simple_info", $html);