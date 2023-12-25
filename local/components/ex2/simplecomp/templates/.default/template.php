<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?php if (!empty($arResult["ITEMS"])) { ?>
<div>
	---<br><br>
	<b><?=GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE")?></b>
	<ul>
		<?php foreach ($arResult["ITEMS"] as $arItem) { ?>
		<li>
			<b><?=$arItem["NAME"]?></b> <?php if ($arItem["DATE_ACTIVE_FROM"]) { ?>- <?=$arItem["DATE_ACTIVE_FROM"]?> <?php } ?>
			<?php if (!empty($arItem["SECTIONS"]["NAMES"])) { ?>
			(<?php foreach ($arItem["SECTIONS"]["NAMES"] as $key => $item) { ?><?php if ($key == count($arItem["SECTIONS"]["NAMES"]) - 1) { ?><?=$item?><?php } else { ?><?=$item?>, <?php } ?><?php } ?>)
			<?php } ?>
				<ul>
					<?php foreach ($arItem["PRODUCTS"] as $item) { ?>
						<li>
							<?php if ($item["NAME"]) { ?>
								<?=$item["NAME"]?>
							<?php } ?>
							<?php if ($item["NAME"]) { ?>
								- <?=$item["PROPERTY_PRICE_VALUE"]?>
							<?php } ?>
							<?php if ($item["PROPERTY_MATERIAL_VALUE"]) { ?>
								- <?=$item["PROPERTY_MATERIAL_VALUE"]?>
							<?php } ?>
							<?php if ($item["PROPERTY_MATERIAL_VALUE"]) { ?>
								- <?=$item["PROPERTY_ARTNUMBER_VALUE"]?>
							<?php } ?>
						</li>
					<?php } ?>
				</ul>
		</li>
		<?php } ?>
	</ul>
</div>
<?php } ?>