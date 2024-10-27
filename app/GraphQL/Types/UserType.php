<?php

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'email' => [
                'type' => Type::string(),
                'resolve' => function(User $root, array $args) {
                    return strtolower($root->email);
                }
            ],
            'customAttribute' => [
                'type' => Type::string(),
                'selectable' => false,
                'resolve' => fn() => 'This is a custom attribute'
            ],
            // Uses the 'sessions' function on User model
            'sessions' => [
                'type' => Type::listOf(GraphQL::type('Session')),
            ],
        ];
    }
}
