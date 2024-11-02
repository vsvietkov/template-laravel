<?php

namespace App\GraphQL\Schemas;

class DefaultSchema extends Base
{
    public function toConfig(): array
    {
        return [
            'query' => $this->loadQueries(),
            'mutation' => $this->loadMutations(),
            // The types only available in this schema
            'types' => $this->loadTypes(),
            // Laravel HTTP middleware
            'middleware' => null,
            // Which HTTP methods to support; must be given in UPPERCASE!
            'method' => ['GET', 'POST'],
            // An array of middlewares, overrides the global ones
            'execution_middleware' => null,
        ];
    }
}
