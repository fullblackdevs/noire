<?php
namespace App\Core\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RoutesLoaderMiddleware implements MiddlewareInterface
{
	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
	{
		if (key_exists('HTTP_HOST', $request->getServerParams()) && str_starts_with($request->getServerParams()['HTTP_HOST'], 'media.blacc')) {
			$request = $request->withAttribute('routing', 'media');
		}

		return $handler->handle($request);
	}
}
