<?php

namespace App\GraphQL\Queries;

use Closure;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Tymon\JWTAuth\Facades\JWTAuth;
use GraphQL\Type\Definition\ResolveInfo;

class MyProfileQuery extends Query
{
    private $auth;

    protected $attributes = [
        'name' => 'My Profile Query',
        'description' => 'My Profile Information'
    ];

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = NULL, $getSelectFields = NULL): bool
    {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            $this->auth = null;
        }
        return (bool) $this->auth;
    }

    public function type(): Type
    {
        return GraphQL::type('users');
    }


    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): User
    {
        $where = function ($query) use ($args) {
            $query->where('id', $this->auth->id);
        };

        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return User::with($with)
            ->where($where)
            ->select($select)
            ->first();
    }
}
