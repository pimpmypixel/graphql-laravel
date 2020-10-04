<?php

use App\GraphQL\Mutations\User\NewUser;
use App\GraphQL\Mutations\User\UpdateUser;
use App\GraphQL\Mutations\User\DeleteUser;
use App\GraphQL\Queries\User\UsersQuery;
use App\GraphQL\Types\User\UsersType;
use App\GraphQL\Types\Product\ProductsType;
use App\Models\Product;

return [
    'prefix' => 'graphql',
    'routes' => 'query/{graphql_schema?}',
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',
    'middleware' => [],
    'default_schema' => 'default',
    'schemas' => [
        'default' => [
            'query' => [
                'Users' => UsersQuery::class,
            ],
            'mutation' => [
                'NewUser' => NewUser::class,
                'UpdateUser' => UpdateUser::class,
                'DeleteUser' => DeleteUser::class,
            ],
            'middleware' => [],
            'method' => ['get', 'post'],
        ],
    ],
    'types' => [
        'users'  => UsersType::class,
        'products'  => ProductsType::class,
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key'    => 'params'
];
