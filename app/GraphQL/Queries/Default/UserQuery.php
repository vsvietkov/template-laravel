<?php

namespace App\GraphQL\Queries\Default;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'user', // TODO: Add a test to exclude duplicated names in a scope of single schema
    ];

    public function type(): Type
    {
        return GraphQL::type(class_basename(User::class));
    }

    public function args(): array
    {
        return [
            'id' => Type::nonNull(Type::int()),
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        return User::query()
            ->withOnlyRequestedColumns($getSelectFields)
            ->find($args['id']);
    }
}
