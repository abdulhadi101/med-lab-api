<?php

namespace App\GraphQL\Mutations;

use App\Http\Controllers\AuthenticationController;

class Login
{
    protected $authController;

    public function __construct(AuthenticationController $authController)
    {
        $this->authController = $authController;
    }

    public function __invoke($_, array $args)
    {
        return $this->authController->login($_, $args);
    }
}
