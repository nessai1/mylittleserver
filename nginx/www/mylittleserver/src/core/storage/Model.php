<?php

namespace Core\Storage;

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
	final protected function save(): void
	{
		$this->repository->saveModel($this);
	}


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