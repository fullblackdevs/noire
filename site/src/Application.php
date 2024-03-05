<?php
namespace App;

use App\Core\AbstractApplication;
use App\Core\Middleware\RoutesLoaderMiddleware;
use App\Middleware\SessionMiddleware;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\JsonConfig;
use Cake\Core\Configure\Engine\PhpConfig;
use Exception;
use RuntimeException;
use Slim\Factory\AppFactory as SlimAppFactory;
use Slim\App as SlimApp;

class Application extends AbstractApplication
{
	private SlimApp $app;

	public function __construct(SlimApp $app)
	{
		$this->initialize();

		$app = $this->registerRoutes($app);
		$app = $this->registerMiddleware($app);

		//$app->add(SessionMiddleware::class);
		$this->app = $app;
	}

	/**
	 * Startup Application
	 *
	 * @return SlimApp
	 * @throws RuntimeException
	 */
	public static function startup() : SlimApp
	{
		$app = SlimAppFactory::create();  // create a Slim App instance using the Factory
		return (new Application($app))->getApp();
	}

	/**
	 * Register routes
	 *
	 * Registers routes from config/routes.php
	 *
	 * @param SlimApp $app
	 * @return SlimApp
	 */
	private function registerRoutes(SlimApp $app): SlimApp
    {
		$routers = [];

		// load Management routes
		if (str_starts_with($_SERVER['HTTP_HOST'], 'media.blacc')) {
			if (!file_exists(ROUTES . 'manage.php')) {
				throw new Exception('Management Routes not found.');
			}

			$routers[] = require_once ROUTES . 'manage.php';
		}

		// load API routes
		if (str_starts_with($_SERVER['HTTP_HOST'], 'media.blacc') || str_starts_with($_SERVER['HTTP_HOST'], 'api.blacc')) {
			if (!file_exists(ROUTES . 'api.php')) {
				throw new Exception('API Routes not found.');
			}

			$routers[] = require_once ROUTES . 'api.php';
		}

		if ($routers && is_array($routers)){
			foreach($routers as $routes) {
				$app = $routes($app);
			}
		} else {
			if (!file_exists(CONFIG . 'routes.php')) {
				throw new Exception('Routes not found.');
			}

			/** @var Closure $routes */
			$routes = require_once CONFIG . 'routes.php';
			$app = $routes($app);
		}

        return $app;
    }

	public function getApp() : SlimApp
	{
		return $this->app;
	}

	protected function initializeConfig() : void
	{
		try {
			Configure::config('default', new PhpConfig());
			Configure::load('app', 'default', false);

			Configure::config('default', new JsonConfig(DATA));
		} catch (Exception $e) {
			exit($e->getMessage() . "\n");
		}
	}

	private function registerMiddleware(SlimApp $app): SlimApp
    {
        //$app->add(RoutesLoaderMiddleware::class);

        return $app;
    }
}
