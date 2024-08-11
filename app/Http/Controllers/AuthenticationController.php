<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;

use App\Services\Authentication;
use App\Traits\HttpResponses;
use Illuminate\Validation\ValidationException;


class AuthenticationController extends Controller
{
    use HttpResponses;

    public $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function register($rootValue, array $args)
    {
        try {
            $this->authentication->register($args);
            return 'User Created';
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function login($rootValue, array $args)
    {
        try {
            $response = $this->authentication->login($args);
            return $response;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function logout($rootValue, array $args, $context)
    {
        $context['request']->user()->tokens()->delete();
        return 'Logged out successfully';
    }

}
