<?php
use Slim\App;

use App\Action\Trailer\ViewTrailerAction;

return function (App $app) {
	$app->get('[/]', ViewTrailerAction::class);

	return $app;
};
