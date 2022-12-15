<?php

namespace WebLab\Core\Storage\DatabaseStorage;
use WebLab\Core\CoreException;

class DatabaseException extends CoreException
{
	protected static string $prefix = '[DATABASE EXCEPTION]';
}