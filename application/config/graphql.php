<?php

use App\GraphQL\Mutations\User\NewUser;
use App\GraphQL\Mutations\User\UpdateUser;
use App\GraphQL\Mutations\User\DeleteUser;
use App\GraphQL\Queries\User\Users;
use App\GraphQL\Types\User\Users as UsersType;

return [
    'prefix' => 'graphql',
    'routes' => 'query/{graphql_schema?}',
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',
    'middleware' => [],
    'default_schema' => 'default',
    'schemas' => [
        'default' => [
            'query' => [
                'User' => Users::class,
                'Users' => Users::class,
            ],
            'mutation' => [
                'NewUser' => NewUser::class,
                'UpdateUser' => UpdateUser::class,
                'DeleteUser' => DeleteUser::class,
            ],
            'middleware' => []
        ],
    ],
    'types' => [
        'users'  => UsersType::class,
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key'    => 'params'
];
