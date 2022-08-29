<?php

namespace App\Database;

use App\Core\Application;

class m0005_create_books_table
{
    private $builder;

    public function __construct()
    {
        $this->builder = Application::get('database');
    }

    public function up()
    {
        $query = "CREATE TABLE books (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id)
            )  ENGINE=INNODB;";

        $this->builder->execute($query);
    }

    public function down()
    {
        $query = "DROP TABLE books;";
        $this->builder->execute($query);
    }
}