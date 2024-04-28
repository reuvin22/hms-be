<?php

namespace App\Observers;

use App\Models\MedicationHistory;
use App\Models\PatientMedication;

class PatientMedicationObserver
{
    /**
     * Handle the PatientMedication "created" event.
     */
    public function created(PatientMedication $patientMedication): void
    {
        //
    }

    /**
     * Handle the PatientMedication "updated" event.
     */
    public function updated(PatientMedication $patientMedication): void
    {
        MedicationHistory::create([
            'patient_id' => $patientMedication->patient_id,
            'physician_id' => $patientMedication->physician_id,
            'medicine_id' => $patientMedication->medicine_id,
            'dosage' => $patientMedication->dose,
            'form' => $patientMedication->form,
            'qty' => $patientMedication->qty,
            'frequency' => $patientMedication->frequency,
            'sig' => $patientMedication->sig,
            'status' => $patientMedication->status
        ]);
    }

    /**
     * Handle the PatientMedication "deleted" event.
     */
    public function deleted(PatientMedication $patientMedication): void
    {
        //
    }

    /**
     * Handle the PatientMedication "restored" event.
     */
    public function restored(PatientMedication $patientMedication): void
    {
        //
    }

    /**
     * Handle the PatientMedication "force deleted" event.
     */
    public function forceDeleted(PatientMedication $patientMedication): void
    {
        //
    }
}
