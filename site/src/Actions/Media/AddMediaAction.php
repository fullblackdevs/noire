<?php
namespace App\Actions\Media;

use App\Core\Action\CoreAction;
use App\Repositories\UsersRepository;
use Psr\Http\Message\ResponseInterface;

class AddMediaAction extends CoreAction
{
	public function invoke(): ResponseInterface
	{
		$Users = new UsersRepository();

		// add a error to the Errors stack if no Users are found or add support
		// to upload media anonymously

		return $this->getView()->render($this->getResponse(), 'Components/Media/Form/AddMediaForm.php', [
			'users' => $Users->getUsersList(),
		]);
	}
}
