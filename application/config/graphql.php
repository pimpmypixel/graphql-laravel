<?php

use App\GraphQL\Mutations\NewUserMutation;
use App\GraphQL\Queries\UsersQuery;
use App\GraphQL\Types\UsersType;

return [
    'prefix' => 'graphql',
    'routes' => 'query/{graphql_schema?}',
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',
    'middleware' => [],
    'default_schema' => 'default',
    // register query  
    'schemas' => [
        'default' => [
            'query' => [
                'users' => UsersQuery::class,
            ],
            'mutation' => [
                'NewUser' => NewUserMutation::class,
            ],
            'middleware' => []
        ],
    ],
    // register types
    'types' => [
        'users'  => UsersType::class,
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key'    => 'params'
];
