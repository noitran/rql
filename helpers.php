<?php

namespace {

    use Noitran\RQL\Services\RQLService;

    if (! function_exists('rql')) {
        /**
         * Get default RQL service
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
}
