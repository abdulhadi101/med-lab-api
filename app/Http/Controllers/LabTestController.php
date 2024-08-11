<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestDataRequest;
use App\Http\Resources\LabResource;
use App\Models\LabTest;
use App\Services\LaboratoryService;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;



class LabTestController extends Controller
{
    use HttpResponses;

    protected $labTest;

    public function __construct(LaboratoryService $labTest)
    {
        $this->labTest = $labTest;
    }

    public function submitMedicalData($rootValue, array $args)
    {
        try {
            $this->labTest->submitMedicalData($args['username'], $args['data']);
            return 'Data submitted successfully';
        } catch (ModelNotFoundException $e) {
            throw new \Exception('User not found.');
        } catch (Exception $e) {
            throw new \Exception('An error occurred: ' . $e->getMessage());
        }
    }
}
