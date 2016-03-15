<?php

namespace App\Providers\Facades;

use Illuminate\Support\Facades\Facade;
use League\CommonMark\CommonMarkConverter;

class MarkdownFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CommonMarkConverter::class;
    }
}
