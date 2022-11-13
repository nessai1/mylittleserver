<?php

namespace Core\Storage\DatabaseStorage;

class Database
{
	private static Database|null $database = null;

	protected function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	/**
	 * Return database instance
	 * @throws DatabaseError
	 */
	public static function getDatabase(): Database
	{
		if (static::$database !== null) {
			return static::$database;
		}

		$config = \Core\Config::getConfig()->get('database');
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

	/**
	 * Execute query and return list of rows
	 * @param string $query
	 * @param array $params
	 * @return array
	 * @throws DatabaseException
	 */
	public function query(string $query, array $params = []): array
	{
		try {
			$statement = $this->pdo->prepare($query);
			$statement->execute($params);
			return $statement->fetchAll(\PDO::FETCH_ASSOC);
		} catch (\PDOException $e) {
			throw new DatabaseException("PDOException appear while query: {$e->getMessage()}");
		}
	}

	/**
	 * Execute query without return
	 * @param string $query
	 * @param array $params
	 * @return void
	 * @throws DatabaseException
	 */
	public function execute(string $query, array $params = []): void
	{
		try {
			$statement = $this->pdo->prepare($query);
			$statement->execute($params);
		} catch (\PDOException $e) {
			throw new DatabaseException("PDOException appear while execute: {$e->getMessage()}");
		}
	}
}