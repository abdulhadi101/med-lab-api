<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestDataRequest;
use App\Http\Resources\LabResource;
use App\Models\LabTest;
use App\Services\LaboratoryService;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

;

class LabTestController extends Controller
{
    use HttpResponses;

    protected $labTest;

    public function __construct(LaboratoryService $labTest)
    {
        $this->labTest = $labTest;
    }

    public function index()
    {
         $test = LabTest::paginate(100);
         return $this->success( LabResource::collection($test), '', );
    }
    public function submit(TestDataRequest $request)
    {

        $username = $request->input('username');
        $data = $request->input('data');

        try {
            // Use the service to submit the medical data
            $this->labTest->submitMedicalData($username, $data);

            return $this->success('', 'Data submitted successfully', 200);
        } catch (ModelNotFoundException $e) {
            // Handle the case where the user is not found
            return $this->error( 'User not found.', 404);
        } catch (Exception $e) {
            // Handle any other exceptions
            return $this->error( 'An error occurred: ',  500, $e->getMessage(),);
        }

    }
}
