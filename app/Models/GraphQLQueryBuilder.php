<?php

namespace App\Models;

use Closure;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Rebing\GraphQL\Support\SelectFields;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GraphQLQueryBuilder extends Builder
{
    public static function defaultGraphQlArguments(): array
    {
        return [
            'limit' => Type::int(),
            'offset' => Type::int(),
            'order' => Type::string(),
            'groupBy' => Type::string(),
        ];
    }

    /**
     * Use to query only requested columns in target table and related tables.
     */
    public function withOnlyRequestedColumns(Closure $getSelectFields): self
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return $this->select($select)->with($with);
    }

    public function withDefaultGraphQlArguments(?array $arguments, string $tableName): self
    {
        if (!$arguments) {
            return $this;
        }

        $limit = Arr::get($arguments, 'limit');
        $offset = Arr::get($arguments, 'offset');
        $order = Arr::get($arguments, 'order');
        $groupBy = Arr::get($arguments, 'groupBy');
        // TODO: Add joins

        $limit && $this->limit($limit);
        $offset && $this->offset($offset);
        $order && $this->applyOrder($order, $tableName);
        $groupBy && $this->applyGroupBy($groupBy);

        return $this;
    }

    private function applyOrder(string $order, string $tableName): void
    {
        $orderParts = explode(',', $order);
        $orderResults = array_map(
            function ($partItem) use ($tableName) {
                if (
                    !preg_match(
                        '/^(?<table>[a-z]{1,25}_?[a-z]{1,25}\.)?(?<column>[a-zA-Z0-9_]{2,50}) (?<direction>desc|asc)$/i',
                        trim($partItem),
                        $orderMatches
                    )
                ) {
                    throw new HttpException(
                        422,
                        'You\'ve requested ORDER but it has an incorrect format. Correct format: `column asc, table.column desc`'
                    );
                }

                $table = Arr::get($orderMatches, 'table', '');
                $column = Arr::get($orderMatches, 'column', '');
                $direction = Arr::get($orderMatches, 'direction', '');

                return [
                    $table ? $table . $column : $tableName . $column,
                    $direction
                ];
            },
            $orderParts
        );

        foreach ($orderResults as $orderResult) {
            $this->orderBy($orderResult[0], $orderResult[1]);
        }
    }

    private function applyGroupBy(string $groupBy): void
    {
        preg_match('/^[a-z0-9.,]+$/i', $groupBy, $matches);

        if (!$matches) {
            throw new HttpException(
                422,
                'You\'ve requested GROUP BY but it has an incorrect format. Correct format: `column` OR `table.column` OR `table.column1,table.column2`'
            );
        }
        $groupByFields = explode(',', $groupBy);

        $this->groupBy($groupByFields);
    }
}
