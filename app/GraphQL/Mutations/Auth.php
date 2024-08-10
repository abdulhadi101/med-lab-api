<?php

namespace App\GraphQL\Mutations;

use App\Services\Authentication;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Auth
{
    protected $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function login($rootValue, array $args, GraphQLContext $context)
    {
        return $this->authentication->login($args);
    }

    public function register($rootValue, array $args, GraphQLContext $context)
    {
        $this->authentication->register($args);
        return 'User Created';
    }

    public function logout($rootValue, array $args, GraphQLContext $context)
    {
        $context->user()->tokens()->delete();
        return 'Logged out successfully';
    }
}
