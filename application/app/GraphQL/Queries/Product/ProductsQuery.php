<?php

namespace App\GraphQL\Queries\Product;

use App\Models\Product;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class ProductsQuery extends Query
{
    protected $attributes = [
        'name' => 'products',
        'description' => 'A query of products'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('products'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'title' => [
                'name' => 'title',
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
            if (isset($args['title'])) {
                $query->where('title', $args['title']);
            }
        };

        // $users = User::with(array_keys($fields->getRelations()))
        //     ->where($where)
        //     ->select($fields->getSelect())
        //     ->get();

        return Product::where($where)->get();
    }
}
