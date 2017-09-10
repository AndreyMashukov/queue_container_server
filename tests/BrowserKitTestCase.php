<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class BrowserKitTestCase extends BaseTestCase
    {

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
	 * The base URL of the application.
	 *
	 * @var string
	 */
	public $baseUrl = 'http://localhost';

	/**
	 * Files to upload
	 *
	 * @var array
	 */
	private $_files;

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

?>
