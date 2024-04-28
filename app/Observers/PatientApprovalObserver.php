<?php

namespace App\Observers;

use App\Models\PatientHistory;
use App\Models\PatientApproval;

class PatientApprovalObserver
{
    public function created(PatientApproval $patientApproval)
    {

    }

    /**
     * Handle the Patient "updated" event.
     */
    public function updated(PatientApproval $patientApproval): void
    {

    }

    /**
     * Handle the Patient "deleted" event.
     */
    public function deleted(PatientApproval $patientApproval): void
    {
        $patientInfo = $patientApproval->user_data_info;
        $dataArray = [
            'patient_hrn' => $patientApproval->patient_hrn,
            'admitting_physician' => $patientApproval->admitting_physician,
            'message' => $patientInfo->first_name . " " . $patientInfo->last_name . " was approved"
        ];

        PatientHistory::create([
            'user_id' => $patientApproval->patient_id,
            'category' => "Approval History",
            'data' => $dataArray
        ]);
    }

    /**
     * Handle the Patient "restored" event.
     */
    public function restored(PatientApproval $patientApproval): void
    {
        //
    }

    /**
     * Handle the Patient "force deleted" event.
     */
    public function forceDeleted(PatientApproval $patientApproval): void
    {
        //
    }
}
