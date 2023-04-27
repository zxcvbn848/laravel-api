<?php

namespace App\GraphQL\Schemas;

use App\GraphQL\{
    Mutations\UpdateUserPasswordMutation,
    Queries\UsersQuery,
    Types\UserType,
};
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
                UpdateUserPasswordMutation::class,
            ],
            'types' => [
                UserType::class,
            ],
        ];
    }
}
