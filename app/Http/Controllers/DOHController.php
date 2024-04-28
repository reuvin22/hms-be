<?php

namespace App\Http\Controllers;

use SoapClient;
use App\Models\DohBedCapacity;
use App\Models\DohHospOptHai;
use App\Models\DohHospOptDeath;
use App\Models\DohHospOptDschrgsEr;
use App\Models\DohHospOptDschrgsMorbidity;
use App\Models\DohHospOptDschrgsNumDeliv;
use App\Models\DohHospOptDschrgsOpd;
use App\Models\DohHospOptDschrgsOpv;
use App\Models\DohHospOptDschrgsSpecialty;
use App\Models\DohHospOptDschrgsTesting;
use App\Models\DohHospOptMajorOpt;
use App\Models\DohHospOptMinorOpt;
use App\Models\DohHospOptMortDeath;
use App\Models\DohHospOptSummaryPatient;
use App\Models\DohInfoClassification;
use App\Models\DohQualityManagement;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Http\Resources\GenericeResourceCollection;
use App\Http\Resources\GenericResource;
use App\Services\DOHReportService;
use Illuminate\Http\Request;

class DOHController extends Controller
{
    
    // protected $soapWrapper;
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function __construct(Artisaninweb\SoapWrapper\SoapWrapper $soapWrapper)
    // {
    //     $this->soapWrapper = $soapWrapper;
    // }

    public function index(Request $request, DOHReportService $service)
    {
        $service->submitAuthenticationTest("authenticationTest");
        switch($request->slug) {
            // case 'generate':
                // return $this->generateReport();

            // case 'info_classification':
            //     return $this->fetchInfoClassification();

            case 'dohInfoClassification':
                return $service->submitInfoClassification("genInfoClassification", $request->reportingYear);

            case 'dohInfoQualityMgmt':
                return $service->submitInfoQualityManagement("genInfoQualityManagement", $request->reportingYear);

            case 'dohInfoBedCapacity':
                return $service->submitInfoBedCapacity("genInfoBedCapacity", $request->reportingYear);

            case 'dohHospOptSummaryPatient':
                return $service->submitHospOptSummaryPatient("hospOptSummaryOfPatients", $request->reportingYear);

            case 'dohHospOptDishargesSpecialty':
                return $service->submitHospOptDischargesSpecialty("hospOptDischargesSpecialty", $request->reportingYear);

            case 'dohHospOptDishargesMorbidity':
                return $service->submitHospOptDischargesMorbidity("hospOptDischargesMorbidity", $request->reportingYear);

            case 'dohHospOptDishargesNumberDeliveries':
                return $service->submitHospOptDischargesNumberDelivery("hospOptDischargesNumberDeliveries", $request->reportingYear);

            case 'dohHospOptDishargesOpv':
                return $service->submitHospOptDischargesOpv("hospOptDischargesOPV", $request->reportingYear);

            case 'dohHospOptDishargesOpd':
                return $service->submitHospOptDischargesOpd("hospOptDischargesOPD", $request->reportingYear);

            case 'dohHospOptDishargesEr':
                return $service->submitHospOptDischargesEr("hospOptDischargesER", $request->reportingYear);
            
            case 'dohHospOptDishargesEv':
                return $service->submitHospOptDischargesEv("hospOptDischargesEV", $request->reportingYear);

            case 'dohHospOptDishargesTesting':
                return $service->submitHospOptDischargesTesting("hospOptDischargesTesting", $request->reportingYear);

            case 'dohHospOperationDeath':
                return $service->submitHospOperationDeath("hospitalOperationsDeaths", $request->reportingYear);

            case 'dohHospOperationMortalityDeath':
                return $service->submitHospOperationMortalityDeath("hospitalOperationsMortalityDeaths", $request->reportingYear);

            case 'dohHospOperationHai':
                return $service->submitHospOperationHai("hospitalOperationsHAI", $request->reportingYear);

            case 'dohHospOperationMajorOpt':
                return $service->submitHospOperationMajorOpt("hospitalOperationsMajorOpt", $request->reportingYear);

            case 'dohHospOperationMinorOpt':
                return $service->submitHospOperationMinorOpt("hospitalOperationsMinorOpt", $request->reportingYear);
        
            case 'dohStaffingPatern':
                return $service->submitStaffingPatern("staffingPattern", $request->reportingYear);
        
            case 'dohExpenses':
                return $service->submitExpenses("expenses", $request->reportingYear);
        
            case 'dohRevenues':
                return $service->submitRevenues("revenues", $request->reportingYear);
        
            case 'dohSubmittedReport':
                return $service->submitReport("submittedReports", $request->reportingYear);
                
            default:
            
        }
        // try {
        //     $param = array(
        //         "hfhudcode" => $request->hfhudcode,
        //         "year" => $request->year,
        //         "table" => $request->table
        //     );

        // $param = array(
        //     "hfhudcode" =>  $request->hfhudcode,
        //     "reportingyear" => $request->year,
        //     "reportingstatus" => "S", 
        //     "reportedby" => "Jicoy Cortejo", 
        //     "designation" => "Senior Developer", 
        //     "section" => "IT", 
        //     "department" => "IT", 
        //     "datereported" => "2023-12-14 14:38:35"
        // );

        // $param = array(
        //     "hfhudcode" => $request->hfhudcode, 
        //     // "year" => $request->year,
        //     // "table" => $request->table,
        //     "servicecapability" => 1, 
        //     "general" => 1, 
        //     "specialty" => 0, 
        //     "specialtyspecify" => "", 
        //     "traumacapability" => 0, 
        //     "natureofownership" => 1, 
        //     "government" => 0, 
        //     "national" => 0, 
        //     "local" => 0, 
        //     "private" => 1, 
        //     "reportingyear" => $request->year, 
        //     "ownershipothers" => "" 
        // );
        //     $soap = new SoapClient("https://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl");
        //     $xml = $soap->__soapCall($request->method, $param);

        //     $data = simplexml_load_string($xml);
        //     return response()->json([
        //         'data' => $data
        //     ], 200);

        // } catch(\SoapFault $fault) {
        //     return response()->json(['error' => $fault->getMessage()], 500);
        // }
    }

    // private function generateReport()
    // {

    // }

    private function fetchInfoClassification()
    {
        // dsc = doh service capability
        $query = DohInfoClassification::hasDsc()->get();
        $data = new GenericeResourceCollection($query);
        // $data->setTableName('doh_info_classifications');
        // $data->setDisplayFields([
        //     'id',
        //     'sevice_capability_id',
        //     'general_id',
        //     'specialty_id',
        //     'specialty_specify_id',
        //     'trauma_capability_id',
        //     'nature_of_ownership_id',
        //     'government_id',
        //     'national_id',
        // ]);
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
