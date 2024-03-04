<?php
namespace App\Core\Repository;

use Cake\Core\Configure;
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
			// setup s3 fs
		}
	}

	public function getFs(): Filesystem
	{
		return $this->fs;
	}
}
