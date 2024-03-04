<?php
namespace App\Core\Repository;

use Aws\S3\S3Client;
use Cake\Core\Configure;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

abstract class CoreRepository
{
	protected Filesystem $fs;

	public function __construct()
	{
		if (Configure::read('Registry.default.connection') === 'local') {
			$this->fs = new Filesystem(new LocalFilesystemAdapter(REGISTRY));
		} else {
			ray('Using Spaces');
			$this->fs = new Filesystem(new AwsS3V3Adapter(
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
				'config/registry',
			));
		}
	}

	public function getFs(): Filesystem
	{
		return $this->fs;
	}
}
