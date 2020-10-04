<?php

namespace App\GraphQL\Types\Product;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductsType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Products',
        'description' => 'A type',
        'model' => Product::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the product'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of product'
            ],
            'price' => [
                'type' => Type::string(),
                'description' => 'The price of the product'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of the product'
            ],
            'user' => [
                'type' => GraphQL::type('users'),
                'description' => 'The user of the product'
            ]
        ];
    }
    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }
}
