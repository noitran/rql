<?php

declare(strict_types=1);

return [
    /*
     * RQL query parser settings
     */
    'parsers' => [
        /*
         * Name of http query parameter that Request parsers should search for RQL string
         */
        'default_query_parameter' => 'filter',
    ],

    /*
     * Currently available only laravel's eloquent ORM
     */
    'default_processor' => 'eloquent',

    /*
     * List of available ORM processors
     */
    'processors' => [
        'eloquent' => [
            /*
             * Processor handler class that implements ProcessorInterface
             */
            'class' => \Noitran\RQL\Processors\Eloquent\EloquentProcessor::class,

            /*
             * List of strategies how expressions will be applied
             */
            'filter_specs' => [
                \Noitran\RQL\Processors\Eloquent\ApplyComparison::class,
                \Noitran\RQL\Processors\Eloquent\ApplyIfArray::class,
                \Noitran\RQL\Processors\Eloquent\ApplyOr::class,

                // ApplyIfArray is used by default
                // \Noitran\RQL\Processors\Eloquent\ApplyBetween::class,
            ],
        ],
    ],
];
