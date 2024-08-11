<?php

namespace App\GraphQL\Mutations;

use App\Http\Controllers\LabTestController;

class SubmitMedicalData
{
    protected $labTestController;

    public function __construct(LabTestController $labTestController)
    {
        $this->labTestController = $labTestController;
    }

    public function __invoke($_, array $args)
    {
        return $this->labTestController->submitMedicalData($_, $args);
    }
}
