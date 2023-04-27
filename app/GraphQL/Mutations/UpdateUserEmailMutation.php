<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateUserEmailMutation extends Mutation
{
   protected $attributes = [
      'name' => 'updateUserEmail'
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
            'type' => Type::string(),
         ],
         'email' => [
            'name' => 'email', 
            'type' => Type::string(),
         ]
      ];
   }

   protected function rules(array $args = []): array
   {
      return [
         'id' => ['required'],
         'email' => ['required', 'email'],
         // 'password' => $args['id'] !== 1337 ? ['required'] : [],
      ];
   }

   public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
   {
      $user = User::find($args['id']);

      if (!$user) {
         return null;
      }

      $user->email = $args['email'];
      $user->save();

      return $user;
   }
}
