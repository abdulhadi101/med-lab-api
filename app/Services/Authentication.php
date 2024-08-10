<?php

namespace App\Services;


use App\Events\UserPreferenceEvent;
use App\Models\Profile;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Authentication
{
    use HttpResponses;

    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     *
     */
    protected $guard;
    public function __construct(StatefulGuard $guard,)
    {
        $this->guard = $guard;

    }

    /**
     * Register a new user account.
     *
     * @param array $input User registration input data
     *
     * @return void
     */
    public function register(array $input)
    {

        return User::create([
            'name' => strtolower($input['name']),
            'username' => strtolower($input['username']),
            'email' => strtolower($input['email']),
            'password' => Hash::make($input['password']),
        ]);



    }

    /**
     * Attempts to authenticate the user with the provided credentials.
     *
     * @param array $input The login credentials.
     * @throws ValidationException
     */

    public function login(array $input)
    {


        $user = User::where('email', $input['email'])->first();

        if (!$user || !Hash::check($input['password'], $user->password)) {
            return $this->error('', 401, 'Invalid Credentials');

        }

        // Generate a new token
        $token = $user->createToken('API Token')->plainTextToken;

        return $this->success($token, 'Auth Token', 201);
    }

}
