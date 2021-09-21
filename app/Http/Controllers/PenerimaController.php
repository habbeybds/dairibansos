<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\DinsosController;
use App\Models\Penerima;
use App\Exports\PenerimaExport;
use App\Imports\PenerimaImport;
use App\Models\NomorSK;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Importer;

class PenerimaController extends DinsosController
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

    // **Jenis Bantuan List
    public function pageDinsosPenerima()
    {
        $data = $this->getListPenerima()->getData();
        $dataArray = json_decode(json_encode($data), true);
        $results = $dataArray['data'];

        return view('managecp.dinsos.penerima', compact('results'));
    }

    public function pageDinsosTambahPenerima()
    {
        //Get List Kecamatan
        $data_kecamatan = $this->getListKecamatan()->getData();
        $dataArray_kecamatan = json_decode(json_encode($data_kecamatan), true);
        $kecamatan = $dataArray_kecamatan['data'];

        //Get List Desa
        $data_desa = $this->getListDesa()->getData();
        $dataArray_desa = json_decode(json_encode($data_desa), true);
        $desa = $dataArray_desa['data'];

        //Get List Jenis Bantuan
        $data_jenis_bantuan = $this->getListJenisBantuan()->getData();
        $dataArray_jenis_bantuan = json_decode(json_encode($data_jenis_bantuan), true);
        $jenisbantuan = $dataArray_jenis_bantuan['data'];
        return view('managecp.dinsos.penerima.add', compact('kecamatan', 'desa', 'jenisbantuan'));
    }

    public function getDesa()
    {
        $data = $this->getDesaByKecamatan();
        return $data;
    }

    public function TambahPenerima(Request $req)
    {
        print_r($req->input());
        exit;
    }

    public function getimportDataPenerima(Request $req)
    {

        $response = [
            'code' => '',
            'data' => '',
            'message' => '',
            'error_details' => ''
        ];

        $getData = $this->importDataPenerima($req);

        if ($getData->getData()->code == 200) {
            $code = $getData->getData()->code;
            $data = $getData->getData()->data;
            $message = $getData->getData()->message;

            $response = [
                'code' => $code,
                'data' => $data,
                'message' => $message
            ];

            echo json_encode($response);
            exit;
        } else {
            $message = $getData->getData()->error;
            $error_details = $getData->getData()->errorDetails;
            $response['code'] = 400;
            $response['message'] = $message;
            if (isset($error_details) && !empty($error_details)) {

                $response['error_details'] = $error_details;
            }
            echo json_encode($response);
            exit;
        }
    }

    public function submitDataPenerima(Request $req)
    {

        $validate = 'false';

        $params = [
            'data_penerima' => $req->data,
            'nomorSK' => $req->nomor_SK,
            'jenisbantuan_id' => $req->jenisbantuanid,
            'tahapan_bantuan' => $req->tahapanBantuan,
        ];

        $index = 0;

        if (!empty($params['data_penerima']) && sizeof($params['data_penerima']) > 0) {

            $data_insert = [
                'nomor_sk' => $params['nomorSK'],
                'jenisbantuanid' => $params['jenisbantuan_id'],
                'tahapan' => $params['tahapan_bantuan'],
            ];

        
            if($insert_nomorSK = NomorSK::create($data_insert)){
                foreach ($params['data_penerima'] as $key => $data) {

                    $data['no_skid'] =  $insert_nomorSK->id;

                    Penerima::create($data);

                    $validate = 'true';
                }
            };

        } 

        echo ($validate);
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
