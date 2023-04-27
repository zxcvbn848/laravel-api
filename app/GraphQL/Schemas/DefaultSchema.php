<?php

namespace App\GraphQL\Schemas;

use App\GraphQL\Mutations\{
	UpdateUserEmailMutation,
	UpdateUserPasswordMutation,
	UserProfilePhotoMutation,
};
use App\GraphQL\Queries\UsersQuery;
use App\GraphQL\Types\UserType;
use Rebing\GraphQL\Support\{
	Contracts\ConfigConvertible,
	UploadType,
};

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
				UpdateUserEmailMutation::class,
				UserProfilePhotoMutation::class,
			],
			'types' => [
				UserType::class,
				UploadType::class,
			],
		];
	}
}
