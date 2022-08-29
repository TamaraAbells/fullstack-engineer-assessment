<?php

namespace App\Controllers;

use App\Core\Database\Migration;

class HomeController extends BaseController
{

    public function index()
    {
        echo "THIS IS THE BOOK CONTROLLER";
    }

    public function migration()
    {
        return (new Migration())->doMigrations();
    }
}