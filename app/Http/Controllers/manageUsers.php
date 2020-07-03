<?php

namespace App\Http\Controllers;

use App\r_affiliate_info;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

class manageUsers extends Controller
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
        return view('pages.users.table-users',compact('aff','user'));
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
        return view('pages.users.create-users',compact('aff','user'));
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
        $user = new user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->AFF_ID = $request->input('affiliate');
        $user->save();

        return redirect()->back()->with('success','User record was inserted successfully');

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
        $user = user::all();
        return  new JsonResource($user->where('id',$id));
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
        //
        $user =  user::all()->where('id',$id);
        $user->name = $request->name;
        $user->email = $request->email;
        ($request->password)?$user->password = bcrypt($request->password):'';
        $user->AFF_ID = $request->input('affiliates');
        $user->save();

        return redirect()->back()->with('success','User record was updated successfully');
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

        $tax = user::where('id',$request->id)->first();

        if($request->type == 0){
            $tax->USER_DisplayStat = 0;
            $tax->save();
            redirect()->back()->with('success','User record was deactivated successfully');
        }else if($request->type == 1){
            $tax->USER_DisplayStat = 1;
            $tax->save();
            redirect()->back()->with('success','User record was activated successfully');
        }
    }
}
