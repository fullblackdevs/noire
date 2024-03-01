<?php

namespace App\Action\Media;

use App\Core\Action\CoreAction;
use Psr\Http\Message\ResponseInterface;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;
use Psr\Http\Message\UploadedFile;

class UploadMediaAction extends CoreAction
{
	public function invoke(): ResponseInterface
	{
		$ts = time();

		$fs = new Filesystem(new AwsS3V3Adapter(
			new S3Client([
				'version' => $_ENV['DIGITALOCEAN_SPACES_VERSION'],
				'region' => $_ENV['DIGITALOCEAN_SPACES_REGION'],
				'endpoint' => $_ENV['DIGITALOCEAN_SPACES_ENDPOINT'],
				'credentials' => [
					'key' => $_ENV['DIGITALOCEAN_SPACES_KEY'],
					'secret' => $_ENV['DIGITALOCEAN_SPACES_SECRET'],
				],
			]),
			$_ENV['DIGITALOCEAN_SPACES_BUCKET'],
		));

		$data = $this->getRequest()->getParsedBody();

		$log = [
			'user' => $data['user'],
			'ts' => $ts,
			'chapter' => $data['chapter'],
			'event' => [
				'name' => null,
				'date' => $data['event-date'],
			],
			'files' => [],
		];

		foreach ($this->getRequest()->getUploadedFiles()['media'] as $file) {
			$log['files'][] = [
				'name' => $file->getClientFilename(),
				'size' => $file->getSize(),
				'type' => $file->getClientMediaType(),
			];

			/** @var UploadedFile $file */
			$fs->write($data['chapter'] . DS . $file->getClientFilename(), $file->getStream());
		}

		$fs->write($data['chapter'] . DS . "log-{$ts}.json", json_encode($log, JSON_PRETTY_PRINT));

		return $this->getView()->render($this->getResponse(), 'Page/Media/success.php', []);
	}
}
