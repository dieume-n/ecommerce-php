<?php

namespace App\Controllers;

use App\Migration\Migration;

class MigrationController extends Controller
{
    public function up()
    {
        (new Migration)->up();
    }

    public function down()
    {
        (new Migration)->down();
    }
}
