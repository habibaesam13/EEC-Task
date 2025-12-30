<?php

namespace App\Http\Controllers\Api;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use App\Services\PharmacyService;
use App\Http\Requests\EditPharmacy;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePharmacy;

class PharmacyController extends Controller
{
    public function __construct(private PharmacyService $pharmacyService)
    {
        $this->pharmacyService = $pharmacyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->json(
            $this->pharmacyService->all(
                $request->query('per_page', 10)
            )
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePharmacy $request)
    {
        $data = $request->validated();
        try {
            $pharmacy = $this->pharmacyService->store($request->validated());
            return response()->json($pharmacy, 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to create Pharmacy'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(pharmacy $pharmacy)
    {
        try {
            $pharmacy = $this->pharmacyService->show($pharmacy);
            return response()->json(['Pharmacy details' => $pharmacy], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Pharmacy Does not exists'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditPharmacy $request, pharmacy $pharmacy)
    {
        $data = $request->validated();

        $this->pharmacyService->update($pharmacy, $data);

        return response()->json([
            'message' => 'Pharmacy updated successfully',
            'data' => $pharmacy->fresh()
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pharmacy $pharmacy)
    {
        try {
            $this->pharmacyService->destroy($pharmacy);
            return response()->json(['message' => 'Pharmacy Deleted'], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Failed to Destroy Pharmacy'], 500);
        }
    }
}
