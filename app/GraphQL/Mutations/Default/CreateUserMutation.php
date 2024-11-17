<?php

namespace App\GraphQL\Mutations\Default;

use Closure;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser',
    ];

    public function type(): Type
    {
        return GraphQL::type(class_basename(User::class));
    }

    public function args(): array
    {
        return [
            'name' => Type::nonNull(Type::string()),
            'email' => Type::nonNull(Type::string()),
            'password' => Type::nonNull(Type::string()),
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        return User::query()->firstOrCreate(
            ['name' => $args['name'], 'email' => $args['email']],
            ['password' => bcrypt($args['password'])],
        );
    }
}

