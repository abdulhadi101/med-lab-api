<?php

namespace App\Services;

use App\Mail\MedicalDataMail;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;

class LaboratoryService
{
    public function submitMedicalData(string $username, array $data)
    {
        // Retrieve the user by username
        $user = User::where('username', $username)->first();

        if (!$user) {
            throw new ModelNotFoundException('User not found.');
        }

        try {
            // Send the email
            Mail::to('peopleoperations@kompletecare.com')
                ->send(new MedicalDataMail($username, $data, $user->name));
        } catch (Exception $e) {
            // Log the error or handle it accordingly
            throw new Exception('Failed to send email: ' . $e->getMessage());
        }
    }
}
