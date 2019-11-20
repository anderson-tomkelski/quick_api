<?php

return array(
    'default' => 'maindb',
    'connections' => array(
        # Our primary database connection
        'maindb' => array(
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',
            'database'  => 'quickgestao',
            'username'  => 'admin',
            'password'  => 'Mudar@123',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),

        # Our secondary database connection
        'universal' => array(
            'driver'    => 'mysql',
            'host'      => '179.188.52.24',
            'database'  => 'universal',
            'username'  => 'universal',
            'password'  => 'Lkdood@##2!@@',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
    ),
);