<?php
/** Автозагрузка классов */
Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'lib\Exam\EventHandler' => '/local/lib/Exam/EventHandler.php',
]);