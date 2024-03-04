<?php
namespace App\Actions\Content;

use App\Core\Action\CoreAction;
use Psr\Http\Message\ResponseInterface;

class ViewMainContentAction extends CoreAction
{
	public function invoke(): ResponseInterface
	{
		return $this->getView()->render($this->getResponse(), 'Components/Content/Page/MainPage.php', []);
	}
}
