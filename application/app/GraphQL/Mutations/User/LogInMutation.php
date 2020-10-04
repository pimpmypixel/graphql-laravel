<?php

    namespace App\GraphQL\Mutation;

    use GraphQL\Type\Definition\Type;
    use Rebing\GraphQL\Support\Mutation;

    class LogInMutation extends Mutation
    {
      protected $attributes = [
        'name' => 'logIn'
      ];

      public function type(): Type
      {
        return Type::string();
      }

      public function args(): array
      {
        return [
          'email' => [
            'name' => 'email',
            'type' => Type::nonNull(Type::string()),
            'rules' => ['required', 'email'],
          ],
          'password' => [
            'name' => 'password',
            'type' => Type::nonNull(Type::string()),
            'rules' => ['required'],
          ],
        ];
      }

      public function resolve($root, $args): string
      {
        $credentials = [
          'email' => $args['email'],
          'password' => $args['password']
        ];

        $token = auth()->attempt($credentials);

        if (!$token) {
          throw new \Exception('Unauthorized!');
        }

        return $token;
      }
    }