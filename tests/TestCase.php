<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Schema;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, HandleAuthentication;

    protected function setUp(): void
    {
        parent::setUp();

        // DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // for mysql
        // DB::statement('PRAGMA foreign_keys=on;'); // for sqlite
        Schema::enableForeignKeyConstraints();
        $this->withoutExceptionHandling();
    }
}
