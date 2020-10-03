<?php

namespace App\GraphQL\Mutations\User;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\Models\User;

class DeleteUser extends Mutation
{
    protected $attributes = [
        'name' => 'DeleteUser'
    ];

    public function type(): Type
    {
        return GraphQL::type('users');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
        ];
    }

    public function resolve($root, $args): bool
    {
        $user = User::whereId($args['id']);
        if (!$user) {
            return null;
        }
        $deleted = $user->delete();
        return $$deleted;
    }
}
