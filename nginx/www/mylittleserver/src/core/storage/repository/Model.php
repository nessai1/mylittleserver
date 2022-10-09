<?php

namespace Core\Storage\Repository;

use ReturnTypeWillChange;

abstract class Model implements \ArrayAccess
{

	/**
	 * Data of model to save
	 * @var array
	 */
	protected array $modelData;

	protected Repository $repository;

	/**
	 * Save data of model in way described child class
	 * @param array $data
	 * @return void
	 */
	final public function save(): void
	{
		if ($this->isModelValid())
		{
			$this->repository->saveModel($this);
		}
		else
		{
			throw new InvalidModelStructure(self::class);
		}
	}

	abstract protected function isModelValid(): bool;


	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	public function setData(array $modelData): self
	{
		$this->modelData = $modelData;
		return $this;
	}

	public function getData(): array
	{
		return $this->modelData;
	}

	public function getId(): string
	{
		return $this->modelData['ID'];
	}

	public function hasField(string ...$fields)
	{
		foreach ($fields as $field)
		{
			if (!isset($this->modelData[$field]))
			{
				return false;
			}
		}
		return true;
	}


	/* ArrayAccess impl */
	public function offsetSet($offset, $value): void {
		if (is_null($offset))
		{
			$this->modelData[] = $value;
		}
		else
		{
			$this->modelData[$offset] = $value;
		}
	}

	public function offsetExists($offset): bool
	{
		return isset($this->modelData[$offset]);
	}

	public function offsetUnset($offset): void {
		unset($this->modelData[$offset]);
	}

	#[ReturnTypeWillChange]
	public function offsetGet($offset) {
		return $this->modelData[$offset] ?? null;
	}
}