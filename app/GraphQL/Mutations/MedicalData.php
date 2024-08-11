<?php

namespace App\GraphQL\Mutations;

use App\Mail\MedicalDataMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MedicalData
{
    public function submit($rootValue, array $args)
    {
        $user = User::where('username', $args['username'])->first();

        if ($user) {
            Mail::to('peopleoperations@kompletecare.com')
                ->send(new MedicalDataMail($args['username'], $args['data'], $user->name));

            return 'Data submitted successfully';
        }

        return 'User not found';
    }
}
