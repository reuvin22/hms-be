<?php

namespace App\Observers;

use App\Models\Patient;
use App\Models\OrderList;
use App\Models\PatientHistory;
use App\Models\PersonalInformation;

class OrderListObserver
{
    /**
     * Handle the OrderList "created" event.
     */
    public function created(OrderList $orderList): void
    {
        $physician = PersonalInformation::where('personal_id', $orderList->physician_id)->first();
        $patient = PersonalInformation::where('personal_id', $orderList->patient_id)->first();
        $patienthrn = Patient::where('patient_id', $orderList->patient_id)->first();
        $dataArray = [
            'patient_hrn' => $patienthrn->patient_hrn,
            'nurse_incharge' => $orderList->nurse_incharge,
            'admitting_physician' => $orderList->physician_id,
            'message' => "Dr. ". $physician->first_name . " " . $physician->last_name . " request " . $orderList->name . " for " . $patient->first_name. " ". $patient->last_name
        ];

        PatientHistory::create([
            'user_id' => $orderList->patient_id,
            'category' => "Doctor Orders",
            'data' => $dataArray
        ]);
    }

    /**
     * Handle the OrderList "updated" event.
     */
    public function updated(OrderList $orderList): void
    {
        //
    }

    /**
     * Handle the OrderList "deleted" event.
     */
    public function deleted(OrderList $orderList): void
    {
        //
    }

    /**
     * Handle the OrderList "restored" event.
     */
    public function restored(OrderList $orderList): void
    {
        //
    }

    /**
     * Handle the OrderList "force deleted" event.
     */
    public function forceDeleted(OrderList $orderList): void
    {
        //
    }
}
