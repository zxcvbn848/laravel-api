<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class UsersQuery extends Query
{
   protected $attributes = [
      'name' => 'users',
   ];

   public function type(): Type
   {
      return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('User'))));
   }

   public function args(): array
   {
      return [
         'id' => [
            'name' => 'id',
            'type' => Type::int(),
         ],
         'email' => [
            'name' => 'email', 
            'type' => Type::string(),
            'resolve' => function($root, array $args) {
               // If you want to resolve the field yourself,
               // it can be done here
               return strtolower($root->email);
            },
         ]
      ];
   }

   public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
   {
      $users = User::query();

      if (!empty($args['id'])) {
         $users = $users->where('id', $args['id']);
      }

      if (!empty($args['email'])) {
         $users = $users->where('email', $args['email']);
      }

      return $users->get();
   }
}
