<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenditureRequest;
use App\Http\Requests\UpdateExpenditureRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportExpenditure;
use App\Models\Expenditure;
use App\Jobs\ExpenditureCSVData;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;


class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('viewExpenditure');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function import(StoreExpenditureRequest $request){
        $user = Auth::id();
        $userName = Auth::user()->name; 
        $userEmail = Auth::user()->email; 
        Excel::import(new ImportExpenditure($user, $userName, $userEmail), $request->file('file')->store('files'));
        
        return redirect()->route('expenditure.index')
                            ->with('success', 'CSV Import added on queue. will update you once done.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExpenditureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenditureRequest $request)
    {
        if( $request->has('csv') ) {
            $csv    = file($request->csv);
            $chunks = array_chunk($csv, 1000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();
  
            foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
                if($key == 0){
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new ExpenditureCSVData($data, $header));
            }
  
            return redirect()->route('expenditure.index')
                            ->with('success', 'File Import added on queue. I will mail you once it completed.');
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function show(Expenditure $expenditure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenditure $expenditure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenditureRequest  $request
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenditureRequest $request, Expenditure $expenditure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenditure  $expenditure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenditure $expenditure)
    {
        //
    }
}
