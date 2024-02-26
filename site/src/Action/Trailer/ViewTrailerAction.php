<?php
namespace App\Action\Trailer;

use App\Core\Action\CoreAction;
use Psr\Http\Message\ResponseInterface;

class ViewTrailerAction extends CoreAction
{
	public function invoke(): ResponseInterface
	{
		return $this->getView()->render($this->getResponse(), 'Page/trailer.php', []);
	}
}
