<?php

namespace App\Observers;

use App\Models\PatientNurseNote;
use App\Models\PersonalInformation;

class ProgressNotes
{
    /**
     * Handle the PatientNurseNote "created" event.
     */
    public function created(PatientNurseNote $patientNurseNote): void
    {
        //
    }

    /**
     * Handle the PatientNurseNote "updated" event.
     */
    public function updated(PatientNurseNote $patientNurseNote): void
    {

    }

    /**
     * Handle the PatientNurseNote "deleted" event.
     */
    public function deleted(PatientNurseNote $patientNurseNote): void
    {
        //
    }

    /**
     * Handle the PatientNurseNote "restored" event.
     */
    public function restored(PatientNurseNote $patientNurseNote): void
    {
        //
    }

    /**
     * Handle the PatientNurseNote "force deleted" event.
     */
    public function forceDeleted(PatientNurseNote $patientNurseNote): void
    {
        //
    }
}
