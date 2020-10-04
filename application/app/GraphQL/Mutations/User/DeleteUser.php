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
        return Type::boolean();
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
        $user = User::findOrFail($args['id']);
        return  $user->delete() ? true : false;
    }
}
