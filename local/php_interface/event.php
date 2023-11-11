<?php

/** Регистрация обработчиков событий */

$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler(
    "main",
    "OnBeforeEventAdd",
    ["lib\\Exam\\EventHandler", "onBeforeMailSend"]
);