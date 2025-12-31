<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPharmacy;
use App\Http\Requests\StorePharmacy;
use App\Models\Pharmacy;
use App\Services\PharmacyService;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function __construct(private PharmacyService $pharmacyService)
    {
        $this->pharmacyService = $pharmacyService;
    }

    public function index(Request $request)
    {
        $pharmacies=$this->pharmacyService->all(
                $request->query('per_page', 12)
            );
        return view('pharmacies.index',compact('pharmacies'));
    }
    public function show(Pharmacy $pharmacy)
    {
        try {
            $pharmacy = $this->pharmacyService->show($pharmacy);
            return view('pharmacies.show',compact('pharmacy'));
        } catch (\Throwable $e) {
            return redirect()->back()->with( ['error'=>'Pharmacy Does not exists'] );
        }
    }
    public function create(){
        return view('pharmacies.store');
    }
    public function store(StorePharmacy $request)
    {
        $data = $request->validated();
        try {
            $pharmacy = $this->pharmacyService->store($request->validated());
            return redirect()->route('pharmacies.create')
            ->with(['success'=>"New pharmacy - {$pharmacy->name} - added successfully"]);

        } catch (\Throwable $e) {
            return redirect()->back()->with(['error'=>'can not create new pharmacy']);
        }
    }

    public function edit(Pharmacy $pharmacy){
        return view('pharmacies.edit',compact('pharmacy'));
    }
    public function update(EditPharmacy $request,Pharmacy $pharmacy){
        $data = $request->validated();

        $this->pharmacyService->update($pharmacy, $data);

        return redirect()->route('pharmacies.edit',$pharmacy)->with(['success'=>"Pharmacy Updated Successfully"]);
    }

    public function destroy(Pharmacy $pharmacy)
    {
        try {
            $this->pharmacyService->destroy($pharmacy);
            return redirect()->route('pharmacies')->with(['success' => 'Pharmacy Deleted Successfully']);
        } catch (\Throwable $e) {
            return redirect()->route('pharmacies')->with(['error' => 'Failed to Destroy Pharmacy']);
        }
    }
}
