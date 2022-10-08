<?php

namespace Ovito\Posts;

use Core\Storage\Model;
use Core\Storage\Repository;

class PostModel extends Model
{
	public function setData(array $modelData): self
	{

		return parent::setData($modelData);
	}
}