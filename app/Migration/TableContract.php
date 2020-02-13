<?php

namespace App\Migration;

interface TableContract
{
    /**
     * Run Migration
     *
     * @return void
     */
    public function up();
    /**
     * Rollback Migration
     *
     * @return void
     */
    public function down();
}
