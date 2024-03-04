<?php
namespace App\Repositories;

use App\Core\Repository\CoreRepository;

class UsersRepository extends CoreRepository
{
	private array $Users;

	public function __construct()
	{
		parent::__construct();

		$this->Users = json_decode($this->fs->read('users.json'), true);
	}

	public function getUsers(): array
	{
		return $this->Users['*'];
	}

	public function getUsersList(): array
	{
		$users = [];

		foreach ($this->getUsers() as $user) {
			// get primary email address or take the first one
			$email = null;
			$name = null;

			if (key_exists('channels', $user) && is_array($user['channels']) && !empty($user['channels'])) {
				foreach ($user['channels'] as $index => $channel) {
					if (key_exists('type', $channel) && $channel['type'] === 'email') {
						if ($index === 0) {
							$email = $channel['value'];
						}

						if (key_exists('primary', $channel) && $channel['primary'] === true) {
							$email = $channel['value'];
							break;
						}
					}
				}
			} else {
				// User has no Channels. They won't be included in the list.
				break;
			}

			if ( key_exists('name', $user)
				 && is_array($user['name'])
				 && !empty($user['name'])
				 && key_exists('first', $user['name'])
				 && key_exists('last', $user['name'])
			) {
				$name = $user['name']['first'] . ' ' . $user['name']['last'];
			} else {
				// User has no Name. They won't be included in the list.
				break;
			}

			if ($email && $name) {
				$users[$email] = $name;
			}
		}

		return $users;
	}
}
