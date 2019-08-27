<?php

declare(strict_types=1);

namespace Noitran\RQL {
    use Noitran\RQL\Exceptions\RuntimeException;
    use Noitran\RQL\Services\RQLService;

    if (! \function_exists('rql')) {
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
}
