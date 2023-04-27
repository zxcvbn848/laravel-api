<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UserProfilePhotoMutation extends Mutation
{
   protected $attributes = [
      'name' => 'userProfilePhoto',
   ];

   public function type(): Type
   {
      return GraphQL::type('User');
   }

   public function args(): array
   {
      return [
         'id'             => [
            'name' => 'id',
            'type' => Type::nonNull(Type::int()),
         ],
         'profilePicture' => [
            'name' => 'profilePicture',
            'type' => GraphQL::type('Upload'),
         ],
      ];
   }

   protected function rules(array $args = []): array
   {
      return [
         'id'             => ['required', 'numeric', 'exists:users,id'],
         'profilePicture' => ['required', 'image', 'max:1500'],
      ];
   }

   public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
   {
      $file = $args['profilePicture'];

      // TODO: store file

      $user = User::find($args['id']);

      // Do something with file here...

      return $user;
   }
}
