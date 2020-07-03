<?php

namespace App\Http\Controllers;

use App\Providers\sympiesProvider;
use MagpieApi;
use App\r_affiliate_info;
use App\r_inventory_info;
use App\r_product_info;
use App\r_product_type;
use App\r_tax_table_profile;
use App\t_product_variance;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Psy\Util\Json;
use Illuminate\Support\Facades\DB;

class manageProduct extends Controller
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
        $prodType =  r_product_type::all();
        $taxProf =  r_tax_table_profile::all();
        $prodInfo = r_product_info::with('rAffiliateInfo','rProductType')->get();
        (Auth::user()->role=='admin')?'':$prodInfo=$prodInfo->where('AFF_ID',Auth::user()->AFF_ID);

        return view('pages.products.table-product',compact('prodType','prodInfo','taxProf','aff'));
    }


    public function actDeact(Request $request)
    {
        $prodInfo = r_product_info::where('PROD_ID', $request->id)->first();

        if($request->type == 0) {
            $prodInfo->PROD_DISPLAY_STATUS = 0;
            $prodInfo->updated_at = Carbon::now();
            $prodInfo->save();
            redirect()->back()->with('success','Product record was deactivated successfully');
        }else if($request->type ==1 ){
            $prodInfo->PROD_DISPLAY_STATUS = 1;
            $prodInfo->updated_at = Carbon::now();
            $prodInfo->save();
            redirect()->back()->with('success','Product record was activated successfully');
        }
    }

    public  function appDisapprove(Request $request){

        $prodInfo = r_product_info::where('PROD_ID', $request->id)->first();

        if($request->type == 0) {
            $prodInfo->PROD_IS_APPROVED = 0;
            $prodInfo->PROD_APPROVED_AT = Carbon::now();
            $prodInfo->updated_at = Carbon::now();
            $prodInfo->save();
            return redirect()->back()->with('success','Product record rejected!');
        }else if($request->type ==1 ){

            $prodInfo->PROD_MY_PRICE = $request->prodmyprice;
            $prodInfo->PROD_IS_APPROVED = 1;
            $prodInfo->PROD_APPROVED_AT = Carbon::now();
            $prodInfo->updated_at = Carbon::now();
            $prodInfo->save();
            return redirect()->back()->with('success','Product record approved!');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aff = r_affiliate_info::all();
        $prodType =  r_product_type::all();
        $taxProf =  r_tax_table_profile::all();
        $prodInfo = r_product_info::with('rAffiliateInfo','rProductType')->get();

        return view('pages.products.create-product',compact('prodType','prodInfo','taxProf','aff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prodInfo = new r_product_info();
        $inv = new r_inventory_info();

        $imageFile = $request->file('prodimg');

        if (isset($imageFile)) {
            $imageName = $request->prodcode.'.'.$imageFile->getClientOriginalExtension();
            if (!file_exists('uploads/'))
                mkdir('uploads/', 666, true);
            ini_set('memory_limit', '512M');
            Image::make($imageFile)->save(public_path('uploads/' . $imageName));
            $prodInfo->PROD_IMG ='uploads/' . $imageName;;
        }
        $prodInfo->PROD_CODE = $request->prodcode;
        $prodInfo->PROD_NAME = $request->prodname;
        $prodInfo->PROD_BASE_PRICE = $request->baseprice;
        $prodInfo->PROD_INIT_QTY = $request->inv_qty;
        $prodInfo->PROD_DISCOUNT = $request->discount;
        $prodInfo->PROD_CRITICAL = $request->inv_critical;
        $prodInfo->PRODT_ID = $request->input('prodtype');

        $prodInfo->PROD_DESC = $request->proddesc;
        $prodInfo->PROD_NOTE = $request->prodnote;
        $prodInfo->AFF_ID = $request->affiliate;
        ($request->start && $request->end)?$prodInfo->PROD_AVAILABILITY = $request->start.' to '.$request->end:'';
        $prodInfo->PROD_IS_APPROVED = 1;

        if(Auth::user()->role=="admin"){
            try {

                $prodInfo->PROD_MY_PRICE = $request->prodmyprice;
                $prodInfo->PROD_IS_APPROVED = 1;
                $prodInfo->PROD_APPROVED_AT = Carbon::now();
                $prodInfo->save();

                if(!trim($request->inv_qty)==""){
                    $inv->INV_QTY = $request->inv_qty;
                    $inv->INV_TYPE = 'CAPITAL';
                    $inv->PROD_ID = $prodInfo->PROD_ID;
                    $inv->save();
                }
                return redirect()->back()->with('success', 'Successfully record is inserted!');
            }catch (\Exception $e){
                return redirect()->back()->with('error',$e->getCode());
            }
        }else if(Auth::user()->role=="member"){
            try {
                $prodInfo->save();

                return redirect()->back()->with('success', 'Successfully record is inserted!');
            }catch (\Exception $e){
                return redirect()->back()->with('error',$e->getCode());
            }
        }

        else
            return abort(500);
        if(!trim($request->inv_qty)==""){
            $inv->INV_QTY = $request->inv_qty;
            $inv->INV_TYPE = 'CAPITAL';
            $inv->PROD_ID = $prodInfo->PROD_ID;
            $inv->save();
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
        $prodInfo = r_product_info::with('rAffiliateInfo','rProductType')
            ->get(['PROD_CODE','PROD_ID','PROD_BASE_PRICE','PRODT_ID','PROD_DESC'
                ,'PROD_IMG','PROD_NAME','PROD_NOTE','PROD_MY_PRICE','PROD_INIT_QTY','PROD_CRITICAL'])
            ->where('PROD_ID',$id);

        $prodInfo = sympiesProvider::format($prodInfo)->toArray();

        $image = DB::Select('select PROD_IMG from r_product_infos where PROD_ID ='.$id)[0]->PROD_IMG;

        $img = array(['IMG'=>asset(($image)?$image:'uPackage.png')]);
        return  new JsonResource(array_merge($prodInfo,$img));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aff = r_affiliate_info::all();
        $prodType =  r_product_type::all();
        $taxProf =  r_tax_table_profile::all();
        $prodInfo = r_product_info::with('rAffiliateInfo','rProductType')->where('PROD_ID',$id)->get()->first();

        return view('pages.products.update-product',compact('prodInfo','aff','prodType','taxProf','id'));
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
        $prodInfo = r_product_info::where('PROD_ID',$id)->first();
        $imageFile=$request->file('prodimg');
        if (isset($imageFile)) {
            $imageName = $request->prodcode.'.'.$imageFile->getClientOriginalExtension();
            if (!file_exists('uploads/'))
                mkdir('uploads/', 666, true);
            ini_set('memory_limit', '512M');
            Image::make($imageFile)->save(public_path('uploads/' . $imageName));
            $prodInfo->PROD_IMG ='uploads/' . $imageName;
        }
        $prodInfo->PROD_NAME = $request->prodname;
        $prodInfo->PROD_BASE_PRICE = $request->baseprice;
        $prodInfo->PROD_MY_PRICE = $request->prodmyprice;
        $prodInfo->PROD_INIT_QTY = $request->inv_qty;
        $prodInfo->PROD_DISCOUNT = $request->discount;
        $prodInfo->PROD_CRITICAL = $request->inv_critical;
        $prodInfo->PRODT_ID = $request->input('prodtype');

        $prodInfo->PROD_DESC = $request->proddesc;
        $prodInfo->PROD_NOTE = $request->prodnote;
        $prodInfo->AFF_ID = $request->affiliate;
        ($request->start && $request->end)?$prodInfo->PROD_AVAILABILITY = $request->start.' to '.$request->end:'';

        if(Auth::user()->role=="admin"){
            try {
                $prodInfo->PROD_IS_APPROVED = 1;
                $prodInfo->save();
                return redirect()->back()->with('success', 'Successfully record is updated!');
            }catch (\Exception $e){
                return redirect()->back()->with('error',$e->getCode());
            }

        }else if(Auth::user()->role=="member"){
            try {
                $prodInfo->save();
                return redirect()->back()->with('success', 'Successfully record is updated!');
            }catch (\Exception $e){
                return redirect()->back()->with('error',$e->getMessage());
            }
        }
        else
            return abort(500);
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

    public function ProductVar(Request $request){

//        try{
            $lastID= array();
            for($i=0; $i < count($request->get('prodvarname'));$i++){
                if($request->prodVarID[$i] == 0) {
                    $prodVar = new t_product_variance();
                    $inv = new r_inventory_info();
                    $prodVar->PRODV_INIT_QTY = $request->inv_qty[$i];
                }
                else if($request->prodVarID[$i] != 0) {
                    $prodVar = t_product_variance::where('PRODV_ID', $request->prodVarID[$i])->first();

                }
                $prodVar->PROD_ID = $request->prodID;
                $prodVar->PRODV_NAME = $request->prodvarname[$i];
                $prodVar->PRODV_DESC = $request->prodvardesc[$i];
                $prodVar->PRODV_ADD_PRICE = $request->addprice[$i];
                $prodVar->PRODV_INIT_QTY = $request->inv_qty[$i];
                $prodVar->PRODV_SKU = $request->SKU[$i];
                if (isset($request->file('prodvarimg')[$i])) {
                    $imageFile = $request->file('prodvarimg')[$i];
                    $imageName = $request->SKU[$i].'.'.$imageFile->getClientOriginalExtension();
                    if (!file_exists('uploads/'))
                        mkdir('uploads/', 666, true);
                    ini_set('memory_limit', '512M');
                    Image::make($imageFile)->save(public_path('uploads/' . $imageName));
                    $prodVar->PRODV_IMG ='uploads/' . $imageName;
                }
                $prodVar->save();


                if($request->prodVarID[$i] == 0) {
                    if(!trim($request->inv_qty[$i])==""){
                        $inv->INV_QTY = $request->inv_qty[$i];
                        $inv->INV_TYPE = 'CAPITAL';
                        $inv->PROD_ID = $request->prodID;
                        $inv->PRODV_ID = $prodVar->PRODV_ID;
                        $inv->save();
                    }
                }

                array_push($lastID,$prodVar->PRODV_ID);
                array_push($lastID,$request->prodVarID[$i]);
            }
            t_product_variance::whereNotIn('PRODV_ID',$lastID)->Where('PROD_ID','=',$request->prodID)->delete();
            r_inventory_info::whereNotIn('PRODV_ID',$lastID)->delete();
            return redirect()->back()->with('success', 'Successfully product variance record is/are updated!');
//        }catch (\Exception $e){
////            return redirect()->back()->with('error',$e->getCode());
//            return $e->getMessage().$e->getLine().count($request->get('prodVarID'));
//        }

    }
    public function showProductVar($id){
        $prodInfo = t_product_variance::with('rProductInfo')
            ->get();
        return  new JsonResource($prodInfo->where('PROD_ID',$id));
    }

    public function showProduct($id){
        $prodInfo = r_product_info::all();
        return  new JsonResource($prodInfo->where('PROD_ID',$id));
    }

    public function deleteAllProductVar(Request $request){
        r_inventory_info::where('PROD_ID',$request->id)->where('PRODV_ID','')->delete();
        t_product_variance::where('PROD_ID',$request->id)->delete();
        redirect()->back()->with('success', 'Successfully all product variance record deleted!');
    }

    public function updateDiscount(Request $request){

        try
        {
            $prodDisc = r_product_info::where('PROD_ID',$request->prodID)->first();
            $prodDisc->PROD_DISCOUNT = $request->prodDiscount;
            $prodDisc->updated_at = Carbon::now();
            $prodDisc->save();
            return redirect()->back()->with('success', 'Successfully product discount record is updated!');
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getCode());
        }
    }



}
