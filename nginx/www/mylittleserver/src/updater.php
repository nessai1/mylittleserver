<?php

require_once __DIR__ . '/autoload.php';

$version = \Core\Application::getApplication()->getVersion();
if ($version < 2) {
	\Core\Application::getApplication()->setVersion(2);
	\Core\Storage\DatabaseStorage\Database::getDatabase()->execute('

CREATE TABLE IF NOT EXISTS category (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(255) NOT NULL UNIQUE 
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

if ($version < 3) {
	\Core\Application::getApplication()->setVersion(3);
	\Core\Storage\DatabaseStorage\Database::getDatabase()->execute('
	INSERT INTO category (name) VALUES ("Автомобили"), ("Недвижимость"), ("Работа"), ("Услуги");
	');
}