<?php

require_once __DIR__ . '/autoload.php';

$version = \Core\Application::getApplication()->getVersion();

if ($version < 2) {
	\Core\Application::getApplication()->setVersion(2);
	\Core\Storage\DatabaseStorage\Database::getDatabase()->execute('

CREATE TABLE IF NOT EXISTS category (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
    );

CREATE TABLE IF NOT EXISTS ad(
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TITLE VARCHAR(255) NOT NULL,
    DESCRIPTION TEXT NOT NULL,
    CATEGORY_ID INT NOT NULL,
    EMAIL VARCHAR(255) NOT NULL,
    FOREIGN KEY (CATEGORY_ID) REFERENCES category(ID) ON DELETE CASCADE
    );

CREATE INDEX ad_category_id ON ad(CATEGORY_ID);
CREATE INDEX ad_email ON ad(EMAIL);
');

}