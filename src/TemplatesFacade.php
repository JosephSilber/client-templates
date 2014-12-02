<?php namespace Silber\Templates;

use Illuminate\Support\Facades\Facade;

class TemplatesFacade extends Facade {

	protected static function getFacadeAccessor()
	{
		return 'Silber\Templates\Templates';
	}

}
