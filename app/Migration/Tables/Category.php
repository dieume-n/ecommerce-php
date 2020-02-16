<?php

namespace App\Migration\Tables;

use App\Migration\TableContract;
use illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

class Category implements TableContract
{
    /**
     * Run Migration
     *
     * @return void
     */
    public function up()
    {
        Manager::schema()->dropIfExists('categories');
        Manager::schema()->create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Rollback migration
     *
     * @return void
     */
    public function down()
    {
        Manager::schema()->dropIfExists('categories');
    }
}
