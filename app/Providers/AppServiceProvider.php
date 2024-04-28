<?php

namespace App\Providers;

use App\Models\Patient;
use App\Models\OrderList;
use App\Models\PatientOPD;
use App\Models\DoctorOrder;
use App\Models\ProgressNotes;
use App\Models\PatientBilling;
use App\Models\PatientApproval;
use App\Models\PatientMedication;
use App\Observers\PatientObserver;
use App\Models\PersonalInformation;
use App\Observers\ApprovalObserver;
use App\Observers\OrderListObserver;
use App\Observers\DoctorOrderObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\ProgressNotesObserver;
use App\Observers\PatientMedicationObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Patient::observe(PatientObserver::class);
        PatientMedication::observe(PatientMedicationObserver::class);
        ProgressNotes::observe(ProgressNotesObserver::class);
        OrderList::observe(OrderListObserver::class);
        DoctorOrder::observe(DoctorOrderObserver::class);
        // PatientApproval::observe(ApprovalObserver::class);
        // PersonalInformation::observe(PatientObserver::class);
        // PatientBilling::observe(PatientObserver::class);
    }
}
