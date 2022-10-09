<?php

namespace Ovito\Posts;

use Core\Storage\Repository\Model;
use Core\Storage\Repository;

class PostModel extends Model
{
	protected function isModelValid(): bool
	{
		return $this->hasField('title', 'text', 'category', 'email');
	}

	public function getCleanTitle(): string
	{
		return static::formatString($this->modelData['title'] ?? '');
	}

	public function getCleanText(): string
	{
		return static::formatString($this->modelData['text'] ?? '');
	}

	public function getCleanCategory(): string
	{
		return static::formatString($this->modelData['category'] ?? '');
	}

	public function getCleanEmail(): string
	{
		return static::formatString($this->modelData['email'] ?? '');
	}
}