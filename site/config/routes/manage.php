<?php

use App\Actions\Media\AddMediaAction;
use Slim\App;

return function (App $app) {
	$app->get('[/]', AddMediaAction::class);

	return $app;
};
