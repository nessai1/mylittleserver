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
}