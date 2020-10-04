<?php

namespace App\GraphQL\Queries\User;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
        'description' => 'A query of users'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('users'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string()
            ]
        ];
    }


    public function resolve($root, $args, $fields): Collection
    {
        $where = function ($query) use ($args) {
            if (isset($args['id'])) {
                $query->where('id', $args['id']);
            }
            if (isset($args['email'])) {
                $query->where('email', $args['email']);
            }
        };

        // $users = User::with(array_keys($fields->getRelations()))
        //     ->where($where)
        //     ->select($fields->getSelect())
        //     ->get();

        return User::where($where)->get();
    }
}
