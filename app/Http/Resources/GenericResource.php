<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\AboutUs;
use App\Models\Module;
use App\Models\BedFloor;
use App\Models\BedGroup;
use App\Models\BedList;
use App\Models\BedType;
use App\Models\DoctorOrder;
use App\Models\DohInfoClassification;
use App\Models\HospitalCharge;
use App\Models\HospitalChargeCategory;
use App\Models\HospitalPhysicianCharge;
use App\Models\InventoryIssue;
use App\Models\InventoryItemStockList;
use App\Models\Pathology;
use App\Models\Patient;
use App\Models\PatientApproval;
use App\Models\PatientOPD;
use App\Models\Radiology;
use App\Models\PatientImgResult;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenericResource extends JsonResource
{
    protected $hiddenFields = [];
    protected $alwaysVisibleFields = [];
    protected $use24HourFormat = false;

    public function setHiddenFields(array $fields)
    {
        $this->hiddenFields = $fields;
    }

    public function setAlwaysVisibleFields(array $fields)
    {
        $this->alwaysVisibleFields = $fields;
    }

    public function set24HourFormat($value)
    {
        $this->use24HourFormat = $value;
    }

    public function toArray(Request $request): array
    {
        // Start with an empty response
        if(!$this->resource) {
            return [];
        }

        $response = [];

        foreach ($this->alwaysVisibleFields as $field) {
            $response[$field] = $this->resource->{$field} ?? null;
        }

        // Retrieve all attributes and filter out hidden ones for this model
        foreach ($this->resource->getAttributes() as $attribute => $value) {
            if (!in_array($attribute, $this->hiddenFields) && !array_key_exists($attribute, $response)) {
                $response[$attribute] = $value;
            }
        }

        // Format the date
        if (isset($this->resource->created_at)) {
            // $response['created_at'] = $this->resource->created_at->format('d M Y h:i A');
            $response['created_at'] = $this->use24HourFormat
                ? $this->resource->created_at->format('H:i')
                : $this->resource->created_at->format('d M Y h:i A');
        }

        // Include relationships when loaded
        if($this->resource instanceof HospitalCharge) {
            $response['charge_type'] = $this->whenLoaded('charge_type');
            $response['charge_category'] = $this->whenLoaded('charge_category');
        } else if($this->resource instanceof AboutUs) {
            $response['about_us'] = $this->whenLoaded('about_us');
        } else if($this->resource instanceof Module) {
            $response['modules'] = $this->whenLoaded('modules');
        } else if($this->resource instanceof HospitalChargeCategory) {
            $response['charge_type'] = $this->whenLoaded('charge_type');
        } else if($this->resource instanceof HospitalPhysicianCharge) {
            $response['identity'] = $this->whenLoaded('identity');
        } else if($this->resource instanceof BedGroup) {
            $response['bed_floor'] = $this->whenLoaded('bed_floor');
        } else if($this->resource instanceof BedList) {
            $response['bed_type'] = $this->whenLoaded('bed_type');
            $response['bed_group'] = $this->whenLoaded('bed_group');
        } else if($this->resource instanceof PatientOPD) {
            // new update
            $response['user_datainfo'] = $this->whenLoaded('user_datainfo');
            $response['physician_datainfo'] = $this->whenLoaded('physician_datainfo');
            $response['patient_history'] = $this->whenLoaded('patient_history');
        } else if($this->resource instanceof Patient) {
            $response['user_data_info'] = $this->whenLoaded('user_data_info');
            $response['physician_data_info'] = $this->whenLoaded('physician_data_info');
            $response['clerk_data_info'] = $this->whenLoaded('clerk_data_info');
            $response['patient_history'] = $this->whenLoaded('patient_history');
            $response['doctor_orders'] = $this->whenLoaded('doctor_orders');
            $response['health_monitors'] = $this->whenLoaded('health_monitors');
        } else if($this->resource instanceof DohInfoClassification) {
            $response['service_capability'] = $this->whenLoaded('service_capability');
        } else if($this->resource instanceof Pathology) {
            $response['pathology_category'] = $this->whenLoaded('pathology_category');
            $response['pathology_parameters'] = $this->whenLoaded('pathology_parameters');
        } else if($this->resource instanceof Radiology) {
            $response['radiology_category'] = $this->whenLoaded('radiology_category');
        } else if($this->resource instanceof InventoryItemStockList) {
            $response['item_category'] = $this->whenLoaded('item_category');
        } else if($this->resource instanceof InventoryIssue) {
            $response['item_category'] = $this->whenLoaded('item_category');
            $response['item_status'] = $this->whenLoaded('item_status');
        } else if($this->resource instanceof PatientApproval) {
            $response['user_data_info'] = $this->whenLoaded('user_data_info');
            $response['physician_data_info'] = $this->whenLoaded('physician_data_info');
            $response['clerk_data_info'] = $this->whenLoaded('clerk_data_info');
        } else if($this->resource instanceof DoctorOrder) {
            $response['progress_notes'] = $this->whenLoaded('progress_notes');
            $response['order_lists'] = $this->whenLoaded('order_lists');
        } else if($this->resource instanceof PatientImgResult) {
            $response['patient_img_results'] = $this->whenLoaded('patient_img_results');
        }

        return $response;
    }
}