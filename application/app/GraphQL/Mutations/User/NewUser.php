<?php

namespace App\GraphQL\Mutations\User;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Models\User;

class NewUser extends Mutation
{
    protected $attributes = [
        'name' => 'NewUser'
    ];

    public function type(): Type
    {
        // return Type::listOf(GraphQL::type('users'));
        return GraphQL::type('users');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }
    public function resolve($root, $args): User
    {
        // dd($args);
        $args['password'] = bcrypt($args['password']);
        $user = User::create($args);
        if (!$user) {
            return null;
        }
        return $user;
    }
}
