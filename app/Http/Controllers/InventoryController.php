<?php

namespace App\Http\Controllers;

use Predis\Response\Status;
use Illuminate\Http\Request;
use App\Models\InventoryIssue;
use App\Models\InventoryItemCategory;
use App\Models\InventoryItemStockList;
use App\Http\Resources\GenericResource;
use App\Http\Resources\GenericeResourceCollection;
use App\Models\ItemStatus;
use App\Services\SettingService;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $slug = $request->input('slug');

        switch($slug) {
            case 'inventory-stock-list':
                return $this->fetchStockList($request);
            break;

            case 'item-category':
                return InventoryItemCategory::all();
            break;

            case 'item-category-list':
                return $this->fetchInventoryItemCategory($request);
            break;

            case 'inventory-issue':
                return $this->fetchIssue($request);
            break;

            case 'item_status':
                return ItemStatus::all();
            break;
        }

    }

    private function fetchStockList($request) {
        $query = InventoryItemStockList::hasCategory();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $patientList = $query->paginate($request->items);

            $data = new GenericeResourceCollection($patientList);
            $data->setTableName('inventory_item_stock_lists');
            $data->setDisplayFields([
                'item',
                'category_id',
                'supplier',
                'date',
                'total_quantity',
                'purchase_price',
                'created_at'
            ]);
            $data->set24HourFormat(true);
        } else {
            $stockList = $query->get();
            $data = GenericResource::collection($stockList)->map(function ($patient) use($request) {
                if($patient) {
                    $resource = new GenericResource($patient);
                    $resource->set24HourFormat(true);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchIssue($request) {
        $query = InventoryIssue::hasCategory();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $patientList = $query->paginate($request->items);

            $data = new GenericeResourceCollection($patientList);
            $data->setTableName('inventory_issues');
            $data->setDisplayFields([
                'user_type_id',
                'status_id',
                'issue_to',
                'issue_by',
                'issue_date',
                'return_date',
                'note',
                'category_id',
                'item_id',
                'qty'
            ]);
            $data->set24HourFormat(true);
        } else {
            $stockList = $query->get();
            $data = GenericResource::collection($stockList)->map(function ($patient) use($request) {
                if($patient) {
                    $resource = new GenericResource($patient);
                    $resource->set24HourFormat(true);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    private function fetchInventoryItemCategory($request) {
        $query = InventoryItemCategory::query();

        if ($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->has('items')) {
            $patientList = $query->paginate($request->items);

            $data = new GenericeResourceCollection($patientList);
            $data->setTableName('item_categories');
            $data->setDisplayFields([
                'category_name'
            ]);
            $data->set24HourFormat(true);
        } else {
            $categories = $query->get();
            $data = GenericResource::collection($categories)->map(function ($patient) use($request) {
                if($patient) {
                    $resource = new GenericResource($patient);
                    $resource->set24HourFormat(true);
                    return $resource->toArray($request);
                }
                return [];
            });
        }

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SettingService $service)
    {
        return $service->createBulkAction($request);
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
