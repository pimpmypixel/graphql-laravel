<?php

use App\GraphQL\Mutations\User\NewUser;
use App\GraphQL\Mutations\User\LogInMutation;
use App\GraphQL\Mutations\User\UpdateUser;
use App\GraphQL\Mutations\User\DeleteUser;
use App\GraphQL\Queries\User\UsersQuery;
use App\GraphQL\Queries\Product\ProductsQuery;
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
                'Products' => ProductsQuery::class,
            ],
            'mutation' => [
                'NewUser' => NewUser::class,
                'UpdateUser' => UpdateUser::class,
                'DeleteUser' => DeleteUser::class,
                // 'logIn' => LogInMutation::class,
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
