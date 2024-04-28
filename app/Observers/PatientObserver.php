<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Patient;
use App\Models\PatientHistory;
use App\Models\ApprovalHistory;
use App\Models\PatientApproval;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Auth;
use App\Models\PersonalInformationObserver;

class PatientObserver
{
    /**
     * Handle the Patient "created" event.
     */
    public function created(Patient $patient)
    {

        // $dataArray = [
        //     'patient_hrn' => $patient->patient_hrn,
        //     'admitting_physician' => $patient->admitting_physician,
        //     // 'message' => $personalInfo->first_name
        // ];

        // PatientHistory::create([
        //     'user_id' => $patient->patient_id,
        //     'data' => $dataArray
        // ]);

        PatientApproval::create([
            'patient_info_id' => $patient->id,
            'admitting_clerk' => Auth::user()->user_id,
            'admitting_physician' => $patient->admitting_physician,
            'patient_id' => $patient->patient_id,
            // 'status' => ,
            'type_approval' => $patient->type_visit,
            'is_approved' => "Pending"
        ]);

        // ApprovalHistory::create([
        //     'patien_id' => $patient->patient_id,
        //     'patient_name' => $patient->user_full_name,
        //     'clerk_name' => $patient->clerk_full_name,
        //     'physician_name' => 'Dr. '.$patient->physician_full_name,
        //     'type_approval' => Patient::NEW_OPD,
        // ]);
    }

    /**
     * Handle the Patient "updated" event.
     */
    public function updated(Patient $patient): void
    {
        $patientInfo = $patient->user_data_info;

        $dataArray = [
            'patient_hrn' => $patient->patient_hrn,
            'admitting_physician' => $patient->admitting_physician,
            'message' => $patientInfo->first_name . " " . $patientInfo->last_name . " was admitted"
        ];

        PatientHistory::create([
            'user_id' => $patient->patient_id,
            'category' => "Patient History",
            'data' => $dataArray
        ]);
    }

    /**
     * Handle the Patient "deleted" event.
     */
    public function deleted(Patient $patient): void
    {
        //
    }

    /**
     * Handle the Patient "restored" event.
     */
    public function restored(Patient $patient): void
    {
        //
    }

    /**
     * Handle the Patient "force deleted" event.
     */
    public function forceDeleted(Patient $patient): void
    {
        //
    }
}
