<?php

namespace App\Http\Controllers;

use App\r_affiliate_info;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class manageAffiliates extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $aff = r_affiliate_info::all();
        $user = user::all();
        return view('pages.users.table-affiliates',compact('aff','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $aff = r_affiliate_info::all();
        $user = user::all();
        return view('pages.users.create-affiliates',compact('aff','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $aff = new r_affiliate_info();
        $aff->AFF_CODE = $request->code;
        $aff->AFF_NAME = $request->affname;
        $aff->AFF_PAYMENT_INSTRUCTION = $request->paymentinst;
        $aff->AFF_PAYMENT_MODE = $request->paymentmode;
        $aff->AFF_DESC = $request->desc;
        $aff->save();

        return redirect()->back()->with('success','Affiliate record was inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $aff = r_affiliate_info::all();
        return  new JsonResource($aff->where('AFF_ID',$id));
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

        $aff = r_affiliate_info::where('AFF_ID',$id)->first();

        return view('pages.users.update-affiliates',compact('aff','id'));
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
        $aff =  r_affiliate_info::where('AFF_ID',$id)->first();
        $aff->AFF_CODE = $request->code;
        $aff->AFF_NAME = $request->affname;
        $aff->AFF_PAYMENT_INSTRUCTION = $request->paymentinst;
        $aff->AFF_PAYMENT_MODE = $request->paymentmode;
        $aff->AFF_DESC = $request->desc;
        $aff->save();

        return redirect()->back()->with('success','Affiliate record was updated successfully');
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
    public function actDeact(Request $request){

        $tax = r_affiliate_info::where('AFF_ID',$request->id)->first();

        if($request->type == 0){
            $tax->AFF_DISPLAY_STATUS = 0;
            $tax->save();
            redirect()->back()->with('success','Affiliate record was deactivated successfully');
        }else if($request->type == 1){
            $tax->AFF_DISPLAY_STATUS = 1;
            $tax->save();
            redirect()->back()->with('success','Affiliate record was activated successfully');
        }
    }
}
