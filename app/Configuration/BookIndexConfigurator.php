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

        ]
    ];
}