<?php

namespace App\Configuration;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class BookIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */
    protected $settings = [
        //
    ];

    protected $defaultMapping = [
        'properties' => [
            'title' => [
                'type' => 'text',
                'analyzer' => 'english'
            ],
            'author' => [
                'type' => 'text'
            ],
            'description' => [
                'type' => 'text',
                'analyzer' => 'english'
            ],
            'isbn' => [
                'type' => 'keyword'
            ],
            'edition' => [
                'type' => 'keyword'
            ],
            'language' => [
                'type' => 'keyword'
            ]
        ]
    ];
}