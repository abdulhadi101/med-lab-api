<?php

namespace App\GraphQL\Mutations;

use App\Http\Controllers\AuthenticationController;

class Register
{
    protected $authController;

    public function __construct(AuthenticationController $authController)
    {
        $this->authController = $authController;
    }

    public function __invoke($_, array $args)
    {
        return $this->authController->register($_, $args);
    }
}
