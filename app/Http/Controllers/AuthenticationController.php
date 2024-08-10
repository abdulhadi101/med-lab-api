<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Responses\LoginResponse;
use App\Services\Authentication;
use App\Traits\HttpResponses;
use Illuminate\Validation\ValidationException;


class AuthenticationController extends Controller
{
    use HttpResponses;
    /**
     * The authentication service instance.
     */
    public $authentication;

    /**
     * Constructor method
     *
     * Initializes the authentication service that will be used in this controller.
     *
     * @param Authentication $authentication The authentication service instance.
     */
    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function register(RegisterUserRequest $request)
    {

        try {
            $this->authentication->register($request->all());

            return $this->success('user Created');
        }

        catch (\Exception $e){
            return $this->error($e->getMessage(), '401', 'something went wring');
        }

    }

    /**
     * Login a user account.
     *
     * This handles the Login request, authenticates
     * the user, and returns a Login response.
     *
     * @param LoginRequest $request - The Login request data.
     * @param LoginResponse $loginResponse
     * @return \Illuminate\Http\JsonResponse - The response from Login in.
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {

        try {

          return  $this->authentication->login($request->only('email', 'password'));


        }

        catch (\Exception $e){
            return $this->error($e->getMessage(), '401', 'something went wring');
        }


    }

}
