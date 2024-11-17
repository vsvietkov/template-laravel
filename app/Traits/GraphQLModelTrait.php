<?php

namespace App\Traits;

use App\Models\GraphQLQueryBuilder;

trait GraphQLModelTrait
{
    public function newEloquentBuilder($query): GraphQLQueryBuilder
    {
        return new GraphQLQueryBuilder($query);
    }
}
