<?php

namespace App\Observers;

use App\Models\Patient;
use App\Models\DoctorOrder;
use App\Models\PatientHistory;
use App\Models\PatientNurseNote;
use App\Models\PersonalInformation;

class DoctorOrders
{
    /**
     * Handle the DoctorOrder "created" event.
     */
    public function created(DoctorOrder $doctorOrder): void
    {
        //
    }

    /**
     * Handle the DoctorOrder "updated" event.
     */
    public function updated(DoctorOrder $doctorOrder): void
    {
        $patientInfo = PersonalInformation::where('personal_id', $doctorOrder->patient_id);
        $patient = Patient::where('patient_id', $doctorOrder->patient_id);
        $dataArray = [
            'patient_hrn' => $patient->patient_hrn,
            'nurse_incharge' => $doctorOrder->nurse_incharge,
            'admitting_physician' => $patient->admitting_physician,
            'message' => $patientInfo->first_name . " " . $patientInfo->last_name . " was admitted"
        ];

        PatientHistory::create([
            'user_id' => $doctorOrder->patient_id,
            'category' => "Doctor Orders",
            'data' => $dataArray
        ]);
    }

    /**
     * Handle the DoctorOrder "deleted" event.
     */
    public function deleted(DoctorOrder $doctorOrder): void
    {
        //
    }

    /**
     * Handle the DoctorOrder "restored" event.
     */
    public function restored(DoctorOrder $doctorOrder): void
    {
        //
    }

    /**
     * Handle the DoctorOrder "force deleted" event.
     */
    public function forceDeleted(DoctorOrder $doctorOrder): void
    {
        //
    }
}
