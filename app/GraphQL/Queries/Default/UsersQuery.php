<?php

namespace App\GraphQL\Queries\Default;

use App\Models\GraphQLQueryBuilder;
use App\Models\User;
use Closure;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type(class_basename(User::class)));
    }

    public function args(): array
    {
        return array_merge(GraphQLQueryBuilder::defaultGraphQlArguments(), []);
    }

    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        $users = User::query()
            ->withOnlyRequestedColumns($getSelectFields)
            ->withDefaultGraphQlArguments($args, app(User::class)->getTable());

        return $users->get();
    }
}
