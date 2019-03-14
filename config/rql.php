<?php

return [

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
                // \Noitran\RQL\Processors\Eloquent\ApplyBetween::class, // ApplyIfArray is used by default
            ],
        ],
    ],
];
