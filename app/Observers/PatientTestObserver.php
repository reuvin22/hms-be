<?php

namespace App\Observers;

use App\Models\Pathology;
use App\Models\PatientImgResult;
use App\Models\PatientLabResult;
use App\Models\PatientTest;
use App\Models\Radiology;

class PatientTestObserver
{
    /**
     * Handle the PatientTest "created" event.
     */
    public function created(PatientTest $patientTest): void
    {
        $pathology = Pathology::where('id' , $patientTest->test_id)->first();
        $radiology = Radiology::where('id' , $patientTest->test_id)->first();

        if($patientTest->lab_category === 'pathology') {
            PatientLabResult::create([
                'patient_id' => $patientTest->patient_id,
                'physician_id' => $patientTest->physician_id,
                'test_name' => $pathology->test_name 
            ]);
        }

        if($patientTest->lab_category === 'radiology') {
            PatientImgResult::create([
                'patient_id' => $patientTest->patient_id,
                'physician_id' => $patientTest->physician_id,
                'test_name' => $radiology->test_name,
            ]);
        }
    }

    /**
     * Handle the PatientTest "updated" event.
     */
    public function updated(PatientTest $patientTest): void
    {
        //
    }

    /**
     * Handle the PatientTest "deleted" event.
     */
    public function deleted(PatientTest $patientTest): void
    {
        //
    }

    /**
     * Handle the PatientTest "restored" event.
     */
    public function restored(PatientTest $patientTest): void
    {
        //
    }

    /**
     * Handle the PatientTest "force deleted" event.
     */
    public function forceDeleted(PatientTest $patientTest): void
    {
        //
    }
}
