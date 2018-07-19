<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\Address;
use DB;
use Config;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $res = DB::table('address')->paginate($request->input('num',50));
        return view('admin.address.index',['title'=>'浏览地址','res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    
        return view ('admin.address.add',[

            'title'=>'添加地址',
            
        ]);
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
       
        $res = $request->except(['_token']);
        // dd($res);

        $data = DB::table('address')->insert($res);

        
        if($data){
            return redirect('admin/address');
        } else {
            return back();
        }

      
       //        try{

       //              $data = Address::create($res);

       //          if($data){

       //              return redirect('/admin/address')->with('info','添加成功');

       //              }
       //          } catch (\Exception $e){

       //              return back();
        
       
       //  }

        $res = DB::select('select * from address');

        dd($res);


       

     
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
        $res = DB::table('friends')->where('id',$id)->first();
        return view('admin.address.edit',['title'=>'地址修改','res'=>$res]);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //   
    // $res = User::destroy($id);
        $req = DB::table('address')->where('id',$id)->get();
       
        $res = DB::table('address')->where('id',$id)->delete();

        if ($res) {

            foreach ($req as $k=>$v) {

                unlink($v->id);

                  }
        return redirect('/admin/address')->with('success','删除成功');
    

        if($data){
            return redirect('admin/address');
        } else {
            return back();
        }
     }

     } 
    
}
