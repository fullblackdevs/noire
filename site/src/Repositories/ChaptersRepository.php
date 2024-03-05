<?php
namespace App\Repositories;

use App\Core\Repository\CoreRepository;
use League\Flysystem\FilesystemException;
use League\Flysystem\UnableToReadFile;

class ChaptersRepository extends CoreRepository
{
	private array $Chapters;

	public function __construct()
	{
		parent::__construct();

		$chapters = json_encode([]);

		try {
			$chapters = $this->fs->read('chapters.json');
		} catch (FilesystemException | UnableToReadFile $exception) {
			// handle the error
		}

		$this->Chapters = json_decode($chapters, true);
	}

	public function getChapters(): array
	{
		return isset($this->Chapters['*']) ? $this->Chapters['*'] : [];
	}

	public function getChaptersList(): array
	{
		$chapters = [];

		foreach ($this->getChapters() as $chapter) {
			// get primary email address or take the first one
			$code = null;
			$name = null;

			if (isset($chapter['code'])) {
				$code = $chapter['code'];
			}

			if (isset($chapter['name'])) {
				$name = $chapter['name'];
			} elseif (isset($chapter['city'])) {
				$name = $chapter['city'];
			} elseif (isset($chapter['state'])) {
				$name = $chapter['state'];
			}

			if ($code && $name) {
				$chapters[$code] = 'BLACC ' . ucwords($name);
			} else {
				// don't include incomplete Chapter
			}
		}

		return $chapters;
	}
}
