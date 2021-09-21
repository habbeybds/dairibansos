<?php

namespace App\Http\Controllers\agen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AgenController;

class PenyaluranController extends AgenController
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

    public function pageAgenPenyaluran()
    {
        $data = $this->getListPenyaluran()->getData();
        $dataArray = json_decode(json_encode($data), true);
        $results = $dataArray['data'];


        foreach ($results as $key => $value) {
            
            $results[$key]['nik_sensor'] = [];
            $results[$key]['barang_dipilih'] = [];

            /* Convert Tanggal Penyaluran */
            $phpdatepenyaluran = strtotime($results[$key]['tgl_penyaluran']);
            $tgl_penyaluran = date('d M Y H:i:s', $phpdatepenyaluran);
            $results[$key]['tgl_penyaluran'] = $tgl_penyaluran;
            
            /* Convert Nik Sensor */
            $nik = str_split($value['nik']);
            $convert_nik = '';
            foreach ($nik as $k => $v) {

                if ($k <= 10) {
                    $convert_nik .= $v;
                } else {
                    $convert_nik .= '*';
                }
            }

            $results[$key]['nik_sensor'] = $convert_nik;

            /* Convert Barang yang dipilih */
            $split_barang = explode(',', $value['barang']);

            foreach ($split_barang as $key_barang => $barangid) {
                $data_barang = $this->getListBarangbyID($barangid)->getData();
                $dataArray_barang = json_decode(json_encode($data_barang), true);
                $barang = $dataArray_barang['data'];
                array_push($results[$key]['barang_dipilih'], $barang['nama_barang']);
            }
        }


        return view('managecp.agen.penyaluran', compact('results'));
    }

    public function pageAgenTambahPenyaluran()
    {
        $data_barang = $this->getListAllBarang()->getData();
        $dataArray_barang = json_decode(json_encode($data_barang), true);
        $barang = $dataArray_barang['data'];


        $data_penerima = $this->getListAllPenerima()->getData();
        $dataArray_penerima = json_decode(json_encode($data_penerima), true);
        $penerima = $dataArray_penerima['data'];

        return view('managecp.agen.penyaluran.add', compact('barang', 'penerima'));
    }

    public function autoCompletePenerima(Request $req)
    {
        $data_penerima = $this->getListAllPenerimaByKeywords($req->data)->getData();
        $dataArray_penerima = json_decode(json_encode($data_penerima), true);
        $penerima = $dataArray_penerima['data'];

        return json_encode($penerima);
        
    }

    public function TambahPenyaluran(Request $req)
    {
       
        $getData = $this->addPenyaluran($req);

        if($getData->getData()->code == 200){
            $message = $getData->getData()->data->message;
            return redirect('penyaluranlist')->with('toast_success', $message);
        }else{
            $message = $getData->getData()->error;
            return redirect('panyaluran')->with('toast_error', $message);
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
