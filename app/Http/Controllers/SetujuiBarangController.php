<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\DinsosController;

class SetujuiBarangController extends DinsosController
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

    public function pageDinsosSetujuiBarang()
    {
        $data = $this->getListSetujuiBarang()->getData();
        $dataArray = json_decode(json_encode($data), true);
        $results = $dataArray['data'];

        $data_disetujui = $this->getListDiSetujuiBarang()->getData();
        $dataSetujuiArray = json_decode(json_encode($data_disetujui), true);
        $results_disetujui = $dataSetujuiArray['data'];

        return view('managecp.dinsos.setujuibarang', compact('results','results_disetujui'));
    }

    public function pageDinsosApprovedBarang(Request $req)
    {
        $barangid = !isset($req->data)?'':$req->data;
        
        $data = $this->approveBarang($barangid)->getData();

        echo json_encode($data);
        exit;

    }

    public function pageDinsosCancelledBarang(Request $req)
    {
        $barangid = !isset($req->data)?'':$req->data;
        
        $data = $this->cancelledBarang($barangid)->getData();

        echo json_encode($data);
        exit;
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
