<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\DinsosController;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class JenisBantuanController extends DinsosController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // JENIS BANTUAN MASTER DATA

    // **Jenis Bantuan List
    public function pageDinsosJenisBantuan()
    {   
        $data = $this->getListJenisBantuan()->getData();
        $dataArray = json_decode(json_encode($data), true);
        $results = $dataArray['data'];

        return view('managecp.dinsos.jenisbantuan', compact('results'));
    }

    // **Jenis Bantuan Tambah Data method GET
    public function pageDinsosTambahJenisBantuan(Request $request)
    {
        return view('managecp.dinsos.jenisbantuan.add');
    }

    // **Jenis Bantuan Tambah Data method POST
    public function TambahJenisBantuan(Request $request)
    {   
        $getData = $this->addJenisBantuan($request);

        if($getData->getData()->code == 200){
            $message = $getData->getData()->data->message;
            return redirect('jenisbantuanlist')->with('toast_success', $message);
        }else{
            $message = $getData->getData()->error;
            return redirect('jenisbantuanlist')->with('toast_error', $message);
        }
    }

    /* Jenis Bantuan Ubah */

 

    public function pageDinsosEditJenisBantuan($id)
    {
        $result = $this->getListJenisBantuanById($id)->getData();
        $data = json_decode(json_encode($result), true);
        $data['action']='/updatejenisbantuan/'.$id;
        $data['method']='POST';
        $data['nama_tombol'] = "Update";

        return view('managecp.dinsos.jenisbantuan.edit', compact('data'));

    }

    public function UbahJenisBantuan(Request $request, $id)
    {

       $getData = $this->updateJenisBantuan($request, $id); 
      
       if($getData->getData()->code == 200){
           $message = $getData->getData()->data->message;
           return redirect('jenisbantuanlist')->with('toast_success', $message);
       }else{
           $message = $getData->getData()->error;
           return redirect('jenisbantuanlist')->with('toast_error', $message);
       }
    }

    public function pageDinsosDeleteJenisBantuan($id)
    {
        $getData = $this->deleteJenisBantuan($id); 
       
       if($getData->getData()->code == 200){
           $message = $getData->getData()->data->message;
           return redirect('jenisbantuanlist')->with('toast_success', $message);
       }else{
           $message = $getData->getData()->error;
           return redirect('jenisbantuanlist')->with('toast_error', $message);
       }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
