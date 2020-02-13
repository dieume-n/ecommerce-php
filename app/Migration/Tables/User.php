<?php

namespace App\Migration\Tables;

use App\Migration\TableContract;
use illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

class User implements TableContract
{
    /**
     * Run Migration
     *
     * @return void
     */
    public function up()
    {
        Manager::schema()->create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Rollback migration
     *
     * @return void
     */
    public function down()
    {
        Manager::schema()->dropIfExists('users');
    }
}
