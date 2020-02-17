<?php

namespace AppTest;

use Dotenv\Dotenv;
use AppTest\Traits\Database;
use PHPUnit\Framework\TestCase as TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;

class BaseCase extends TestCase
{
    protected static $capsule;

    /**
     * This method is called before the first test
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        if (!static::$capsule) {
            static::$capsule = new Capsule;
            static::$capsule->addConnection([
                'driver' => getenv('DB_DRIVER'),
                'host' => getenv('DB_HOST'),
                'database' => getenv('DB_DATABASE'),
                'charset' => 'utf8',
                'collation' => "utf8_unicode_ci",
                'prefix' => ''
            ]);
            static::$capsule->setAsGlobal();
            static::$capsule->bootEloquent();
        }
    }
    /**
     * Set up environment before each test
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (class_uses($this, Database::class)) {
            $this->migrateDatabase();
        }
    }

    /**
     * Tear down environment after each test
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        if (class_uses($this, Database::class)) {
            $this->rollBackDatabase();
        }
    }
}
