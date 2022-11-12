<?php

namespace Core\Storage\DatabaseStorage;

class Database
{
	private static Database|null $database;

	protected function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public static function getDatabase(): Database
	{
		if (static::$database !== null) {
			return static::$database;
		}

		$config = $_ENV['database'];
		if (!$config)
		{
			throw new DatabaseError('Database configuration not found');
		}

		$pdo = new \PDO(
			"mysql:host={$config['host']};dbname={$config['database']};charset=utf8",
			$config['username'],
			$config['password']
		);

		$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		static::$database = new Database($pdo);
		return static::$database;
	}

	public function query(string $query, array $params = []): array
	{
		$statement = $this->pdo->prepare($query);
		$statement->execute($params);

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function execute(string $query, array $params = []): void
	{
		$statement = $this->pdo->prepare($query);
		$statement->execute($params);
	}
}