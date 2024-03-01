<?php

namespace App\Core\Action;

use Cake\Chronos\ChronosDate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;
use Faker\Factory as Faker;
use Faker\Generator as FakerGenerator;
use Odan\Session\Flash;
use Slim\Interfaces\RouteParserInterface;
use Slim\Routing\RouteContext;

abstract class CoreAction
{
	protected ServerRequestInterface $request;
	protected ResponseInterface $response;
	private PhpRenderer $renderer;

	private Flash|null $_flash;

	private RouteParserInterface $Router;

	protected FakerGenerator $fake;

	public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
	{
		$this->_initialize($request, $response);

		$this->response = $this->invoke();

		return $this->response;
	}

	protected function _initialize(ServerRequestInterface $request, ResponseInterface $response)
	{
		$this->request = $request;
		$this->response = $response;

		if ($request->getAttribute('session')) {
			$this->_flash = $request->getAttribute('session')->getFlash();
		} else {
			$this->_flash = null;
		}

		$this->Router = RouteContext::fromRequest($request)->getRouteParser();

		$this->fake = Faker::create();

		$this->request = $this->getRequest()->withAttribute('__renderer__', $this->getView());

		if (method_exists($this, 'initialize')) {
			$this->initialize();
		}
	}

	protected function getRequest(): ServerRequestInterface
	{
		return $this->request;
	}

	protected function getResponse(): ResponseInterface
	{
		return $this->response;
	}

	protected function getView(): PhpRenderer
	{
		if (!isset($this->renderer)) {
			$this->renderer = new PhpRenderer(TEMPLATES);
		}

		if (empty($this->renderer->getLayout())) {
			$this->renderer->setLayout('layouts/page.php');
		}

		$this->renderer->addAttribute('now', ChronosDate::now());
		$this->renderer->addAttribute('version', time());
		$this->renderer->addAttribute('Router', $this->getRouter());
		$this->renderer->addAttribute('Flash', $this->_flash);

		return $this->renderer;
	}

	protected function getRouter(): RouteParserInterface
	{
		return $this->Router;
	}

	abstract public function invoke(): ResponseInterface;

	protected function initialize(): void
	{
		// override this method to initialize the action
	}
}
