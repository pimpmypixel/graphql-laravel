<?php

namespace App\GraphQL\Types\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UsersType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Users',
        'description' => 'A type',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user'
            ],
            // realation
            'products' => [
                'type'          => Type::listOf(GraphQL::type('products')),
                'description' => 'The products of the user',
                // query
                // 'args'          => [
                //     'title' => [
                //         'type' => Type::string(),
                //     ],
                // ],
                // 'query'         => function (array $args, $query, $ctx) {
                //     return $query->where('posts.title', "=", $args['title']);
                // }
            ]
        ];
    }
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}
