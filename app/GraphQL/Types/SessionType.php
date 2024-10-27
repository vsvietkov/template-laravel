<?php

namespace App\GraphQL\Types;

use App\Models\Session;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class SessionType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Session',
        'model' => Session::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'user_id' => [
                'type' => Type::int(),
            ],
            'ip_address' => [
                'type' => Type::string(),
            ],
            'user_agent' => [
                'type' => Type::string(),
            ],
            'last_activity' => [
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }
}
