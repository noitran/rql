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

    /*
     * Request filters that will be applied by default, allowing to use them in each query
     */
    'filtering' => [
        /*
         * List allowed logical operators for data filtering and comparision
         */
        'allowed_expressions' => [
            '$eq', // equal or =
            '$notEq', // not equal or !=
            '$lt', // less than
            '$lte', // less than or equal
            '$gt', // greater than
            '$gte', // greater than or equal
            '$like',
            '$in',
            '$notIn',
            '$or',
            '$between',
        ],

        /*
         * What comparison operator should be used by default
         */
        'default_expression' => '$eq',

        /*
         * Available data types are treated in different ways.
         * List of allowed data types
         */
        'allowed_data_types' => [
            '$string',
            '$bool',
            '$int',
            '$date',
            '$datetime',
        ],

        /*
         * How will be search values processed by default
         */
        'default_data_type' => '$string',
    ],
];
