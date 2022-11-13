<?php

namespace Core;

use Core\Storage\DatabaseStorage\Database;
use Core\Storage\DatabaseStorage\DatabaseError;

final class Application
{
	private static Application $application;
	private Database $database;

	public static function getApplication(): Application
	{
		if (!isset(self::$application)) {
			self::initApplication();
		}

		return self::$application;
	}

	public function __construct()
	{
		try {
			$this->database = Database::getDatabase();
		} catch (DatabaseError $e) {
			throw new ApplicationError("Application error appear due connection to database: {$e->getMessage()}");
		}

		$this->initApplicationOptions();
		self::updateApplication();
	}

	public static function initApplication(): void
	{
		self::$application = new Application();
	}

	private function initApplicationOptions(): void
	{
		if (count($this->database->query('SHOW TABLES LIKE "options"')) === 0) {
			$this->database->execute('CREATE TABLE options (name VARCHAR(255) PRIMARY KEY, value VARCHAR(255))');
			$this->database->execute('INSERT INTO options (value, name) values ("1", "version")');
		}
	}

	private static function updateApplication(): void
	{
		require_once __DIR__ . '/../updater.php';
	}

	public function getVersion(): int
	{
		return $this->getOption('version');
	}

	public function setVersion(int $version): void
	{
		$this->setOption('version', $version);
	}

	public function getOption(string $option): string|null
	{
		$result = $this->database->query("SELECT `value` FROM `options` WHERE `name` = :option", [
			':option' => $option
		]);

		if (count($result) === 0) {
			return null;
		}

		return $result[0]['value'];
	}

	public function setOption(string $option, string $value): void
	{
		$this->database->execute("INSERT INTO `options` (`name`, `value`) VALUES (:option, :value) ON DUPLICATE KEY UPDATE `value` = :value", [
			':option' => $option,
			':value' => $value
		]);
	}
}