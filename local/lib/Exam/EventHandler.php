<?php

namespace lib\Exam;


use CEventLog;

/**
 * Класс для обработчиков событий
 */
class EventHandler
{
	/**
	 * Изменение поля AUTHOR перед отправкой письма FEEDBACK_FORM
	 */
	public static function onBeforeMailSend(string &$event, string &$lid, array &$arFields, string &$message_id, array &$files, string &$languageId): void
	{
		if ($event !== "FEEDBACK_FORM") {
			return;
		}
		global $USER;
		if (!$USER->IsAuthorized()) {
			$arFields["AUTHOR"] = "Пользователь не авторизован, данные из формы: ".$arFields["AUTHOR"];
		}
		else {
			$arFields["AUTHOR"] = "Пользователь авторизован: {$USER->GetID()} ({$USER->GetLogin()}) {$USER->GetFullName()}, данные из формы: ".$arFields["AUTHOR"];
		}
		$description = "Замена данных в отсылаемом письме – ".$arFields["AUTHOR"];
		CEventLog::Add(array(
         "SEVERITY" => "INFO",
         "AUDIT_TYPE_ID" => "FEEDBACK_FORM",
         "MODULE_ID" => "main",
         "DESCRIPTION" => $description,
      ));
	}
} 