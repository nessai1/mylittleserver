<?php

namespace WebLab\Integration;

use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\Worksheet;
use WebLab\Core\CoreError;

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $_SERVER['DOCUMENT_ROOT'] . '/../credentials.json');
class GoogleSheets
{
	public static function initClient(): \Google_Client
	{
		$client = new \Google_Client();
		try
		{
			$client->useApplicationDefaultCredentials();
			$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			if ($client->isAccessTokenExpired())
			{
				$client->refreshTokenWithAssertion();
			}
			$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
			ServiceRequestFactory::setInstance(
				new DefaultServiceRequest($accessToken)
			);
			return $client;
		}
		catch (\Exception $e)
		{
			throw new CoreError("Google Sheets API error: {$e->getMessage()}");
		}
	}

	/**
	 * Получить список значений в таблице с $spreadsheetId
	 * @param string $spreadsheetId Та херь, что передается в ссылке на таблицу
	 * @param string $range Диапазон ячеек, который нужно получить (например, A1:B2)
	 * @return array Массив значений
	 */
	public static function getWorkSheets(string $spreadsheetId, string $range): array
	{
		$client = self::initClient();
		$service = new \Google_Service_Sheets($client);
		return $service->spreadsheets_values->get($spreadsheetId, $range)->getValues();
	}

	/**
	 * Записать в конец таблицы значения из $values
	 * @param string $spreadsheetId Та херь, что передается в ссылке на таблицу
	 * @param string $range Диапазон ячеек, с которых надо начинать вставку (можно указать просто буквы, тогда будет вставка в конец)
	 * @param array $values Массив значений
	 * @return void
	 */
	public static function appendWorkSheets(string $spreadsheetId, string $range, array $values): void
	{
		$client = self::initClient();
		$service = new \Google_Service_Sheets($client);
		$body = new \Google_Service_Sheets_ValueRange([
			'values' => [$values]
		]);
		$service->spreadsheets_values->append($spreadsheetId, $range, $body, ['valueInputOption' => 'USER_ENTERED']);
	}
}