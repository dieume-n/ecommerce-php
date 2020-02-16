<?php

namespace App\Migration;

use App\Migration\Tables\Category;
use App\Migration\Tables\User;

class Migration
{
    /**
     * Run Migrations
     *
     * @return void
     */
    public function up()
    {
        (new User)->up();
        (new Category)->up();
    }

    /**
     * Rollback Migrations
     *
     * @return void
     */
    public function down()
    {
        (new User)->down();
        (new Category)->down();
    }
}
