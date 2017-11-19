<?php
namespace Geeklearners\Modalbox\Facade;
use Illuminate\Support\Facades\Facade;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/17/17
 * Time: 3:17 PM
 */
class Modal extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'modal';
    }
}