<?php

namespace App\Core;

use Dotenv\Dotenv;
use Sentry;

abstract class AbstractApplication
{
	protected function initialize(): void
	{
		$this->initializeSentry();
		$this->initializeEnvironmentVars();
		$this->initializeConfig();
	}

	protected function initializeSentry(): void
	{
		Sentry\init([
			'dsn' => 'https://6c949c61398019913e88c8d90dd70fa2@o104948.ingest.sentry.io/4506796687228928',
			'traces_sample_rate' => 1.0,
		]);
	}

	private function initializeEnvironmentVars(): void
	{
		if (!env('APP_NAME') && file_exists(ROOT . DS . '.env')) {
			$dotenv = Dotenv::createImmutable(ROOT . DS);
			$dotenv->load();
		}
	}

	abstract public static function startup();

	abstract protected function initializeConfig();

	abstract public function getApp();
}
