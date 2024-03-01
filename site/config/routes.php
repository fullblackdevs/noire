<?php

use App\Action\Trailer\ViewTrailerAction;
use App\Action\Media\UploadMediaAction;
use Slim\App;

return function (App $app) {
	$app->get('[/]', ViewTrailerAction::class);
	$app->post('/upload', UploadMediaAction::class);

	return $app;
};
