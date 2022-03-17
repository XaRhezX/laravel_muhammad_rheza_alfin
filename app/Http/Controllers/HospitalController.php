<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Http\Requests\StoreHospitalRequest;
use App\Http\Requests\UpdateHospitalRequest;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $hospitals = Hospital::where('id','like','%'.$q.'%')
        ->orWhere('name','like','%'.$q.'%')
        ->orWhere('address','like','%'.$q.'%')
        ->orWhere('email','like','%'.$q.'%')
        ->orWhere('phone','like','%'.$q.'%')
        ->paginate(5);
        return view('hospitals.index', compact('hospitals','q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'create';
        return view('hospitals.view',compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHospitalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHospitalRequest $request)
    {
        $id = Hospital::create($request->only('name','address','phone','email'));
        return $this->show($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        $action = 'view';
        return view('hospitals.view',compact('hospital','action'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        $action = 'edit';
        return view('hospitals.view',compact('hospital','action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHospitalRequest  $request
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHospitalRequest $request, Hospital $hospital)
    {
        $hospital->update($request->all());
        return $this->show($hospital);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function search(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Hospital::select("id", "name")
            ->where('name', 'LIKE', "%$search%")
            ->limit(5)
                ->get();
        }
        return response()->json($data);
    }
}
