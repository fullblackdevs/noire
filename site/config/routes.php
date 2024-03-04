<?php
use App\Actions\Content\ViewMainContentAction;
use Slim\App;

return function (App $app) {
	$app->get('[/]', ViewMainContentAction::class);

	return $app;
};
