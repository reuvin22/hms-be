<?php

namespace App\Services;

use App\Models\DohBedCapacity;
use App\Models\DohHospExpenses;
use App\Models\DohHospOptDeath;
use App\Models\DohHospOptDschrgsEr;
use App\Models\DohHospOptDschrgsEv;
use App\Models\DohHospOptDschrgsMorbidity;
use App\Models\DohHospOptDschrgsNumDeliv;
use App\Models\DohHospOptDschrgsOpd;
use App\Models\DohHospOptDschrgsOpv;
use App\Models\DohHospOptDschrgsSpecialty;
use App\Models\DohHospOptDschrgsTesting;
use App\Models\DohHospOptHai;
use App\Models\DohHospOptMajorOpt;
use App\Models\DohHospOptMinorOpt;
use App\Models\DohHospOptMortDeath;
use App\Models\DohHospOptSummaryPatient;
use App\Models\DohHospRevenue;
use App\Models\DohInfoClassification;
use App\Models\DohQualityManagement;
use App\Models\DohStaffingPatern;
use App\Models\DohSubmittedReport;
use SoapClient;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DOHReportService extends Service {
    function submitAnnualReport($methodName, $param) {
        DB::beginTransaction();
        try {
            Log::debug("Param for $methodName:", $param);

            $soap = new SoapClient("https://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl");
            $xml = $soap->__soapCall($methodName, $param);
            $data = simplexml_load_string($xml);
            return response()->json([
                'data' => $data
            ], 200);
            DB::commit();
        } catch(\SoapFault $ex) {
            DB::rollback();
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    function submitAuthenticationTest($methodName) {
        $toSubmit = [
            'username' => "NEHEHRSV202300009",
            'password' => "123456",
        ];
        $this->submitAnnualReport($methodName, $toSubmit);
    }

    function submitInfoClassification($methodName, $reportingYear) {
        $data = DohInfoClassification::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'servicecapability' => $model['service_capability_id'],
                'general' => $model['general_id'],
                'specialty' => $model['specialty_id'],
                'specialtyspecify' => $model['specialty_specify'],
                'traumacapability' => $model['trauma_capability_id'],
                'natureofownership' => $model['nature_of_ownership_id'],
                'government' => $model['government_id'],
                'national' => $model['national_id'],
                'local' => $model['local_id'],
                'private' => $model['private_id'],
                'reportingyear' => $reportingYear,
                'ownershipothers' => $model['ownership_other'],
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
    }

    function submitInfoQualityManagement($methodName, $reportingYear) {
        $data = DohQualityManagement::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'qualitymgmttype' => $model['quality_mgmt_type_id'],
                'description' => $model['description'],
                'certifyingbody' => $model['certifying_body'],
                'philhealthaccreditation' => $model['philhealth_accreditation_id'],
                'validityfrom' => $model['validation_from'],
                'validityto' => $model['validation_to'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
    }
    
    function submitInfoBedCapacity($methodName, $reportingYear) {
        $data = DohBedCapacity::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'abc' => $model['abc'],
                'implementing_beds' => $model['implementing_beds'],
                'bor' => $model['bor'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOptSummaryPatient($methodName, $reportingYear) {
        $data = DohHospOptSummaryPatient::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'totalinpatients' => $model['total_number_inpatient'],
                'totalnewborn' => $model['total_newborn'],
                'totaldischarges' => $model['total_discharge'],
                'totalpad' => $model['total_pad'],
                'totalibd' => $model['total_ibd'],
                'totalinpatienttransto' => $model['total_inpatient_transto'],
                'totalinpatienttransfrom' => $model['total_inpatient_transfrom'],
                'totalpatientsremaining' => $model['total_patients_remaining'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOptDischargesSpecialty($methodName, $reportingYear) {
        $data = DohHospOptDschrgsSpecialty::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'typeofservice' => $model['type_of_service_id'],
                'nopatients' => $model['no_patients'],
                'totallengthstay' => $model['total_length_stay'],
                'nppay' => $model['np_pay'],
                'nphservicecharity' => $model['nph_service_charity'],
                'nphtotal' => $model['nph_total'],
                'phpay' => $model['ph_pay'],
                'phservice' => $model['ph_service'],
                'phtotal' => $model['ph_total'],
                'hmo' => $model['hmo'],
                'owwa' => $model['owwa'],
                'recoveredimproved' => $model['recovered_improved'],
                'transferred' => $model['transferred'],
                'hama' => $model['hama'],
                'absconded' => $model['absconded'],
                'unimproved' => $model['unimproved'],
                'deathsbelow48' => $model['deaths_below48'],
                'deathsover48' => $model['deaths_over48'],
                'totaldeaths' => $model['total_deaths'],
                'totaldischarges' => $model['total_discharges'],
                'remarks' => $model['remarks'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOptDischargesSpecialtyOthers($methodName, $reportingYear) {
        // $data = DohHospOptDschrgsSpecialty::all();
        
    }
    
    function submitHospOptDischargesMorbidity($methodName, $reportingYear) {
        $data = DohHospOptDschrgsMorbidity::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'icd10desc' => $model['icd10_desc'],
                'munder1' => $model['m_under1'],
                'funder1' => $model['f_under1'],
                'm1to4' => $model['m_1to4'],
                'f1to4' => $model['f_1to4'],
                'm5to9' => $model['m_5to9'],
                'f5to9' => $model['f_5to9'],
                'm10to14' => $model['m_10to14'],
                'f10to14' => $model['f_10to14'],
                'm15to19' => $model['m_15to19'],
                'f15to19' => $model['f_15to19'],
                'm20to24' => $model['m_20to24'],
                'f20to24' => $model['f_20to24'],
                'm25to29' => $model['m_25to29'],
                'f25to29' => $model['f_25to29'],
                'm30to34' => $model['m_30to34'],
                'f30to34' => $model['f_30to34'],
                'm35to39' => $model['m_35to39'],
                'f35to39' => $model['f_35to39'],
                'm40to44' => $model['m_40to44'],
                'f40to44' => $model['f_40to44'],
                'm45to49' => $model['m_45to49'],
                'f45to49' => $model['f_45to49'],
                'm50to54' => $model['m_50to54'],
                'f50to54' => $model['f_50to54'],
                'm55to59' => $model['m_55to59'],
                'f55to59' => $model['f_55to59'],
                'm60to64' => $model['m_60to64'],
                'f60to64' => $model['f_60to64'],
                'm65to69' => $model['m_65to69'],
                'f65to69' => $model['f_65to69'],
                'm70over' => $model['m_70over'],
                'f70over' => $model['f_70over'],
                'msubtotal' => $model['m_sub_total'],
                'fsubtotal' => $model['f_sub_total'],
                'grandtotal' => $model['grand_total'],
                'icd10code' => $model['icd10_code'],
                'icd10category' => $model['icd10_cat'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOptDischargesNumberDelivery($methodName, $reportingYear) {
        $data = DohHospOptDschrgsNumDeliv::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'totalifdelivery' => $model['total_ifdelivery'],
                'totallbvdelivery' => $model['toal_lbvdelivery'],
                'totallbcdelivery' => $model['total_lbcdelivery'],
                'totalotherdelivery' => $model['total_otherdelivery'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOptDischargesOpv($methodName, $reportingYear) {
        $data = DohHospOptDschrgsOpv::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'newpatient' => $model['new_patient'],
                'revisit' => $model['re_visit'],
                'adult' => $model['adult'],
                'pediatric' => $model['pediatric'],
                'adultgeneralmedicine' => $model['adult_general_medicine'],
                'specialtynonsurgical' => $model['specialty_non_surgical'],
                'surgical' => $model['surgical'],
                'antenatal' => $model['antenatal'],
                'postnatal' => $model['postnatal'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOptDischargesOpd($methodName, $reportingYear) {
        $data = DohHospOptDschrgsOpd::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'opdconsultations' => $model['opd_consultations'],
                'number' => $model['number'],
                'icd10code' => $model['icd10_code'],
                'icd10category' => $model['icd10_cat'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
    }
    
    function submitHospOptDischargesEr($methodName, $reportingYear) {
        $data = DohHospOptDschrgsEr::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'erconsultations' => $model['er_consultations'],
                'number' => $model['number'],
                'icd10code' => $model['icd10_code'],
                'icd10category' => $model['icd10_cat'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOptDischargesTesting($methodName, $reportingYear) {
        $data = DohHospOptDschrgsTesting::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'testinggroup' => $model['testing_group_id'],
                'testing' => $model['testing_id'],
                'number' => $model['number'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }

    function submitHospOptDischargesEv($methodName, $reportingYear) {
        $data = DohHospOptDschrgsEv::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'emergencyvisits' => $model['er_visit'],
                'emergencyvisitsadult' => $model['er_visits_adult'],
                'emergencyvisitspediatric' => $model['er_visits_pediatric'],
                'evfromfacilitytoanother' => $model['ev_from_facil_to_another'],
                'evtofacilityfromanother' => $model['ev_to_facil_to_another'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
    }
    
    function submitHospOperationDeath($methodName, $reportingYear) {
        $data = DohHospOptDeath::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'totaldeaths' => $model['total_deaths'],
                'totaldeaths48down' => $model['total_deaths48down'],
                'totaldeaths48up' => $model['total_deaths48up'],
                'totalerdeaths' => $model['total_erdeaths'],
                'totaldoa' => $model['total_doa'],
                'totalstillbirths' => $model['total_stillbirths'],
                'totalneonataldeaths' => $model['total_neonatal_deaths'],
                'totalmaternaldeaths' => $model['total_maternal_deaths'],
                'totaldeathsnewborn' => $model['total_deaths_newborn'],
                'totaldischargedeaths' => $model['total_discharge_deaths'],
                'grossdeathrate' => $model['gross_deathrate'],
                'ndrnumerator' => $model['ndr_numerator'],
                'ndrdenominator' => $model['ndr_denominator'],
                'netdeathrate' => $model['net_deathrate'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOperationMortalityDeath($methodName, $reportingYear) {
        $data = DohHospOptMortDeath::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'icd10desc' => $model['icd10_desc'],
                'munder1' => $model['m_under1'],
                'funder1' => $model['f_under1'],
                'm1to4' => $model['m_1to4'],
                'f1to4' => $model['f_1to4'],
                'm5to9' => $model['m_5to9'],
                'f5to9' => $model['f_5to9'],
                'm10to14' => $model['m_10to14'],
                'f10to14' => $model['f_10to14'],
                'm15to19' => $model['m_15to19'],
                'f15to19' => $model['f_15to19'],
                'm20to24' => $model['m_20to24'],
                'f20to24' => $model['f_20to24'],
                'm25to29' => $model['m_25to29'],
                'f25to29' => $model['f_25to29'],
                'm30to34' => $model['m_30to34'],
                'f30to34' => $model['f_30to34'],
                'm35to39' => $model['m_35to39'],
                'f35to39' => $model['f_35to39'],
                'm40to44' => $model['m_40to44'],
                'f40to44' => $model['f_40to44'],
                'm45to49' => $model['m_45to49'],
                'f45to49' => $model['f_45to49'],
                'm50to54' => $model['m_50to54'],
                'f50to54' => $model['f_50to54'],
                'm55to59' => $model['m_55to59'],
                'f55to59' => $model['f_55to59'],
                'm60to64' => $model['m_60to64'],
                'f60to64' => $model['f_60to64'],
                'm65to69' => $model['m_65to69'],
                'f65to69' => $model['f_65to69'],
                'm70over' => $model['m_70over'],
                'f70over' => $model['f_70over'],
                'msubtotal' => $model['m_sub_total'],
                'fsubtotal' => $model['f_sub_total'],
                'grandtotal' => $model['grand_total'],
                'icd10code' => $model['icd10_code'],
                'icd10category' => $model['icd10_cat'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOperationHai($methodName, $reportingYear) {
        $data = DohHospOptHai::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'numhai' => $model['num_hai'],
                'numdischarges' => $model['num_discharges'],
                'infectionrate' => $model['infection_rate'],
                'patientnumvap' => $model['patient_num_vap'],
                'totalventilatordays' => $model['total_ventilator_days'],
                'resultvap' => $model['result_vap'],
                'patientnumbsi' => $model['patient_num_bsi'],
                'totalnumcentralline' => $model['total_num_centralline'],
                'resultbsi' => $model['result_bsi'],
                'patientnumuti' => $model['patient_num_uti'],
                'totalcatheterdays' => $model['total_catheter_days'],
                'resultuti' => $model['result_uti'],
                'numssi' => $model['num_ssi'],
                'totalproceduresdone' => $model['total_procedures_done'],
                'resultssi' => $model['result_ssi'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOperationMajorOpt($methodName, $reportingYear) {
        $data = DohHospOptMajorOpt::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'operationcode' => $model['operation_code'],
                'surgicaloperation' => $model['surgical_operation'],
                'number' => $model['number'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
        
    }
    
    function submitHospOperationMinorOpt($methodName, $reportingYear) {
        $data = DohHospOptMinorOpt::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'operationcode' => $model['operation_code'],
                'surgicaloperation' => $model['surgical_operation'],
                'number' => $model['number'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
    }

    function submitStaffingPatern($methodName, $reportingYear) {
        $data = DohStaffingPatern::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'professiondesignation' => $model['profession_designation'],
                'specialtyboardcertified' => $model['specialty_board_certified'],
                'fulltime40permanent' => $model['fulltime_40permament'],
                'fulltime40contractual' => $model['fulltime_40contructual'],
                'parttimepermanent' => $model['parttime_permanent'],
                'parttimecontractual' => $model['parttime_contructual'],
                'activerotatingaffiliate' => $model['active_rotating_affiliate'],
                'outsourced' => $model['outsourced'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
    }

    function submitExpenses($methodName, $reportingYear) {
        $data = DohHospExpenses::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'salarieswages' => $model['salaries_wages'],
                'employeebenefits' => $model['employee_benebits'],
                'allowances' => $model['allowances'],
                'totalps' => $model['total_ps'],
                'totalamountmedicine' => $model['total_amount_medicine'],
                'totalamountmedicalsupplies' => $model['total_amount_medical_supp'],
                'totalamountutilities' => $model['total_amount_util'],
                'totalamountnonmedicalservice' => $model['total_amount_nonmedserv'],
                'totalmooe' => $model['total_mooe'],
                'amountinfrastructure' => $model['amount_infras'],
                'amountequipment' => $model['amount_equip'],
                'totalco' => $model['total_co'],
                'grandtotal' => $model['grand_total'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
    }

    function submitRevenues($methodName, $reportingYear) {
        $data = DohHospRevenue::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'amountfromdoh' => $model['amount_fromdoh'],
                'amountfromlgu' => $model['amount_fromlgu'],
                'amountfromdonor' => $model['amount_fromdonor'],
                'amountfromprivateorg' => $model['amount_fromprivorg'],
                'amountfromphilhealth' => $model['amount_from_phealth'],
                'amountfrompatient' => $model['amount_from_patient'],
                'amountfromreimbursement' => $model['amount_from_reimbursement'],
                'amountfromothersources' => $model['amount_from_othersources'],
                'grandtotal' => $model['grand_total'],
                'reportingyear' => $reportingYear
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
    }

    function submitReport($methodName, $reportingYear) {
        $data = DohSubmittedReport::all();
        $dataToSubmit = [];
        foreach($data as $row) {
            $model = $row->getModelAttributes();
            $toSubmit = [
                'hfhudcode' => "NEHEHRSV202300009",
                'reportingyear' => $reportingYear,
                // 'reportingyear' => $model['reporting_year'],
                'reportingstatus' => $model['reporting_status'],
                'reportedby' => $model['reported_by'],
                'designation' => $model['designation'],
                'section' => $model['section'],
                'department' => $model['department'],
                'datereported' => $model['date_reported']
            ];
            $dataToSubmit[] = $this->submitAnnualReport($methodName, $toSubmit);
        }
        return $dataToSubmit;
    }
}