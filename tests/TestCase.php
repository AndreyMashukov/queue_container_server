<?php

namespace Tests;

use \Illuminate\Contracts\Console\Kernel;
use \Illuminate\Foundation\Testing\DatabaseMigrations;
use \Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
    {

	use CreatesApplication;

	use DatabaseMigrations;

	/**
	 * Prepare for testing
	 *
	 * @return void
	 */

	public function setUp()
	    {
		parent::setUp();

		$this->runDatabaseMigrations();
	    }


	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */

	public function createApplication()
	    {
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make(Kernel::class)->bootstrap();
		return $app;
	    }

    }
