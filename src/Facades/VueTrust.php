<?php namespace Bantenprov\VueTrust\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The VueTrust facade.
 *
 * @package Bantenprov\VueTrust
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueTrust extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vue-trust';
    }
}
