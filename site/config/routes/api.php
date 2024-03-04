<?php
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Actions\API\Media\UploadMediaAction;

return function (App $app) {
	$app->group('/api', function (RouteCollectorProxy $api) {
		$api->group('/v0', function(RouteCollectorProxy $api) {
			$api->group('/media', function(RouteCollectorProxy $api) {
				$api->post('/upload', UploadMediaAction::class);
			});
		});
	});

	return $app;
};
