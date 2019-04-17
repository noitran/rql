<?php

declare(strict_types=1);

use Noitran\RQL\Services\RQLService;

if (! function_exists('rql')) {
    /**
     * Get default RQL service.
     *
     * @throws RuntimeException
     *
     * @return RQLService
     */
    function rql()
    {
        return app('rql');
    }
}
