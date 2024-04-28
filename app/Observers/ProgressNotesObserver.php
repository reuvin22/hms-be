<?php

namespace App\Observers;

use App\Models\PatientNurseNote;
use App\Models\ProgressNotes;

class ProgressNotesObserver
{
    /**
     * Handle the ProgressNotes "created" event.
     */
    public function created(ProgressNotes $progressNotes): void
    {
        PatientNurseNote::create([
            'patient_id' => $progressNotes->patient_id,
            'nurse_id' => $progressNotes->nurse_incharge,
            'remarks' => $progressNotes->progress_notes,
        ]);
    }

    /**
     * Handle the ProgressNotes "updated" event.
     */
    public function updated(ProgressNotes $progressNotes): void
    {
        //
    }

    /**
     * Handle the ProgressNotes "deleted" event.
     */
    public function deleted(ProgressNotes $progressNotes): void
    {
        //
    }

    /**
     * Handle the ProgressNotes "restored" event.
     */
    public function restored(ProgressNotes $progressNotes): void
    {
        //
    }

    /**
     * Handle the ProgressNotes "force deleted" event.
     */
    public function forceDeleted(ProgressNotes $progressNotes): void
    {
        //
    }
}
