<?php

namespace Silber\Templates\Laravel;

use Silber\Templates\Templates;
use Illuminate\Support\Facades\Facade;

class TemplatesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Templates::class;
    }
}
