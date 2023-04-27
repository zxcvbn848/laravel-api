<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateUserPasswordMutation extends Mutation
{
   protected $attributes = [
      'name' => 'updateUserPassword'
   ];

   public function type(): Type
   {
      return Type::nonNull(GraphQL::type('User'));
   }

   public function args(): array
   {
      return [
         'id' => [
            'name' => 'id', 
            'type' => Type::nonNull(Type::int()),
         ],
         'password' => [
            'name' => 'password', 
            'type' => Type::nonNull(Type::string()),
         ]
      ];
   }

   protected function rules(array $args = []): array
   {
      return [
         'id'       => ['required', 'numeric', 'exists:users,id'],
         'password' => ['required', 'min:8'],
      ];
   }

   public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
   {
      $user = User::find($args['id']);

      if (!$user) {
         return null;
      }

      $user->password = bcrypt($args['password']);
      $user->save();

      return $user;
   }
}
