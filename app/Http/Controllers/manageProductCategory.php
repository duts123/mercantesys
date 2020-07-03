<?php

namespace App\Http\Controllers;

use App\r_product_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class manageProductCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = r_product_type::with('rProductType')->get();
        return view('pages.products.table-product-category',compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        $cat = r_product_type::with('rProductType')->get();
        return view('pages.products.create-product-category',compact('cat','type'));
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
            $prodcat = new r_product_type();
            $prodcat->PRODT_TITLE =$request->prodttitle;
            $prodcat->PRODT_DESC = $request->prodtdesc;
            if($request->input('prodparent'))
                $prodcat->PRODT_PARENT = $request->input('prodparent');
            $prodcat->save();
            return redirect()->back()->with('success', 'Successfully record is inserted!');
        }catch (\Exception $e){
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
        $prodCat = r_product_type::with('rProductType')
            ->get();

        return  new JsonResource($prodCat->where('PRODT_ID',$id));
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
        try {
            $prodcat = r_product_type::where('PRODT_ID', $id)->first();
            $prodcat->PRODT_TITLE = $request->prodttitle;
            $prodcat->PRODT_DESC = $request->prodtdesc;
            if($request->input('prodparent'))
                $prodcat->PRODT_PARENT = $request->input('prodparent');
            $prodcat->save();
            return redirect()->back()->with('success', 'Successfully record is updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getCode());
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
    public function actDeact(Request $request)
    {
        $prodInfo = r_product_type::where('PRODT_ID', $request->id)->first();

        if($request->type == 0) {
            $prodInfo->PRODT_DISPLAY_STATUS = 0;
            $prodInfo->updated_at = Carbon::now();
            $prodInfo->save();
            redirect()->back()->with('success','Product Category record was deactivated successfully');
        }else if($request->type ==1 ){
            $prodInfo->PRODT_DISPLAY_STATUS = 1;
            $prodInfo->updated_at = Carbon::now();
            $prodInfo->save();
            redirect()->back()->with('success','Product Category record was activated successfully');
        }
    }
}
