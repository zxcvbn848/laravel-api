<?php

namespace App\GraphQL\Schemas;

use App\GraphQL\Queries\UsersQuery;
use App\GraphQL\Types\UserType;
use Rebing\GraphQL\Support\Contracts\ConfigConvertible;

class DefaultSchema implements ConfigConvertible
{
    public function toConfig(): array
    {
        return [
            'query' => [
                UsersQuery::class,
            ],
            'mutation' => [
                ExampleMutation::class,
            ],
            'types' => [
                UserType::class,
            ],
        ];
    }
}
