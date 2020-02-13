<?php

namespace App\Controllers;

use App\Migration\Migration;

class MigrationController
{
    public function run()
    {
        (new Migration)->up();
    }
}
