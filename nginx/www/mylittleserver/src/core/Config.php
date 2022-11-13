<?php

namespace Core;

class Config
{
	private static Config $config;

	public static function getConfig(): Config
	{
		if (!isset(self::$config)) {
			self::$config = new Config();
		}

		return self::$config;
	}

	private function __construct()
	{
		require_once __DIR__ . '/../config.php';
	}

	public function get(string $option): mixed
	{
		return $_ENV[$option] ?? null;
	}
}