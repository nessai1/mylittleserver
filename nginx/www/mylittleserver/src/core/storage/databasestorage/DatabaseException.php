<?php

namespace Core\Storage\DatabaseStorage;
use Core\CoreException;

class DatabaseException extends CoreException
{
	protected static string $prefix = '[DATABASE EXCEPTION]';
}