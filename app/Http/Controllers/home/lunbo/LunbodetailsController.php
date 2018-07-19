<?php

namespace App\Http\Controllers\home\lunbo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LunbodetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($lid)
    {
        //
        //dd($lid);
        $lundid = $lid;
        $lunres = DB::table('lundetails')->where('lundid',$lundid)->get();
        //dd($lunres);
        return view('/home/lunbo/lunbodetails',['title'=>'详情页','lunres'=>$lunres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
}
