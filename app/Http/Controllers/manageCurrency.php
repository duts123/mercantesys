<?php

namespace App\Http\Controllers;

use App\r_currencies;
use App\r_tax_table_profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class manageCurrency extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxProf = r_tax_table_profile::all();
        $curr = r_currencies::with('rTaxTableProfile')->get();

        return view('pages.configuration.table-currencies',compact('curr','taxProf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taxProf = r_tax_table_profile::all();

        return view('pages.configuration.create-currencies',compact('taxProf'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $curr = new r_currencies();
            $curr->CURR_COUNTRY = $request->country;
            $curr->CURR_ACR = $request->acronym;
            $curr->CURR_NAME = $request->name;
            $curr->CURR_RATE = $request->rate;
            $curr->CURR_SYMBOL = $request->symbol;
            $curr->TAXP_ID = $request->input('tax');
            $curr->save();
            return redirect()->back()->with('success', 'Successfully record is inserted!');
        }
        catch (Exception $e){
            return redirect()->back()->with('error',$e->getCode());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curr = r_currencies::with('rTaxTableProfile')->where('CURR_ID',$id)->get();
        return new JsonResource($curr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $curr = r_currencies::where('CURR_ID',$id)->first();
            $curr->CURR_COUNTRY = $request->country;
            $curr->CURR_ACR = $request->acronym;
            $curr->CURR_NAME = $request->name;
            $curr->CURR_RATE = $request->rate;
            $curr->CURR_SYMBOL = $request->symbol;
            $curr->TAXP_ID = $request->input('tax');
            $curr->save();
            return redirect()->back()->with('success', 'Successfully record is updated!');
        }
        catch (Exception $e){
            return redirect()->back()->with('error',$e->getCode());
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
