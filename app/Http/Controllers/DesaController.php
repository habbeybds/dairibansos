<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\DinsosController;

class DesaController extends DinsosController
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

    public function pageDinsosDesa()
    {
        $data = $this->getListDesa()->getData();
        $dataArray = json_decode(json_encode($data), true);
        $results = $dataArray['data'];

        return view('managecp.dinsos.desa', compact('results'));
    }


    public function pageDinsosTambahDesa()
    {

        $data_kecamatan = $this->getListKecamatan()->getData();
        $dataArray_kecamatan = json_decode(json_encode($data_kecamatan), true);
        $kecamatan = $dataArray_kecamatan['data'];

        return view('managecp.dinsos.desa.add', compact('kecamatan'));
    }

    public function TambahDesa(Request $request)
    {
        $getData = $this->addDesa($request);

        if($getData->getData()->code == 200){
            $message = $getData->getData()->data->message;
            return redirect('desalist')->with('toast_success', $message);
        }else{
            $message = $getData->getData()->error;
            return redirect('desalist')->with('toast_error', $message);
        }
    
    }
    public function pageDinsosEditDesa($id)
    {

        $result = $this->getListDesaById($id)->getData();
        
        $data = json_decode(json_encode($result), true);
        
        $data['action']='/updatedesa/'.$id;
        $data['method']='POST';
        $data['nama_tombol'] = "Update";

        $data_kecamatan = $this->getListKecamatan()->getData();
        $dataArray_kecamatan = json_decode(json_encode($data_kecamatan), true);
        $kecamatan = $dataArray_kecamatan['data'];

        return view('managecp.dinsos.desa.edit', compact('data','kecamatan'));

    }

    public function UbahDesa(Request $request, $id)
    {

       $getData = $this->updateDesa($request, $id); 
      
       if($getData->getData()->code == 200){
           $message = $getData->getData()->data->message;
           return redirect('desalist')->with('toast_success', $message);
       }else{
           $message = $getData->getData()->error;
           return redirect('desalist')->with('toast_error', $message);
       }
    }


    public function pageDinsosDeleteDesa($id)
    {
        $getData = $this->deleteDesa($id); 
       
       if($getData->getData()->code == 200){
           $message = $getData->getData()->data->message;
           return redirect('desalist')->with('toast_success', $message);
       }else{
           $message = $getData->getData()->error;
           return redirect('desalist')->with('toast_error', $message);
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
