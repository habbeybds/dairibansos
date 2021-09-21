<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penerima;
use App\Models\Barang;
use App\Models\Penyaluran;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Print_;
use Symfony\Component\Console\Input\Input;

class AgenController extends BaseController
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

    public function getListBarang($id)
    {
        $barang = new Barang();
        $data = $barang->getListDataByAgenID($id);

        return $this->responseOK($data);
    }
    public function getListAllBarang()
    {
        $barang = new Barang();
        $data = $barang->getListDataApproved();

        return $this->responseOK($data);
    }

    public function addBarang(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'inputKodeBarang' => ['required', 'string', 'max:255'],
            'inputNamaBarang' => ['required', 'string', 'max:255'],
            'inputSatuan' => ['required'],
            'inputHarga' => ['required', 'string', 'max:255'],
            'inputStok' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Gagal menambahkan silahkan isi data dengan benar!', 422, $validator->errors());
        }

        // proses format harga
        $get_data_harga = explode(" ", $req->inputHarga);
        $harga = str_replace(".", "", $get_data_harga[1]);

        $params = [
            'agen_id' => session('id'),
            'kode_barang' => $req->inputKodeBarang,
            'nama_barang' => $req->inputNamaBarang,
            'satuan' => $req->inputSatuan,
            'harga' => $harga,
            'stok' => $req->inputStok,
            'status' => 'pending',
        ];

        $barangDB = Barang::where('kode_barang', $params['kode_barang'])->orwhere('nama_barang', $params['nama_barang'])->where('agen_id', $params['agen_id'])->get();
        $dataArray = json_decode(json_encode($barangDB), true);


        if (sizeof($dataArray) == 0) {
            if ($addDesa = Barang::create($params)) {

                $response = [
                    'data' => $addDesa,
                    'message' => 'Berhasil menambah Barang'
                ];

                return $this->responseOK($response, 200);
            } else {
                return $this->responseError('Gagal menambahkan silahkan coba lagi', 400);
            }
        } else {
            return $this->responseError('Kode barang atau nama barang sudah ada', 400);
        }
    }

    public function getListBarangById($id)
    {
        $data = Barang::findOrFail($id);

        return $this->responseOK($data);
    }

    public function updateBarang(Request $req, $id)
    {

        $validator = Validator::make($req->all(), [
            'inputNamaBarang' => ['required', 'string', 'max:255'],
            'inputSatuan' => ['required'],
            'inputHarga' => ['required', 'string', 'max:255'],
            'inputStok' => ['required', 'string', 'max:255'],
        ]);


        if ($validator->fails()) {
            return $this->responseError('Gagal merubah silahkan isi data dengan benar!', 422, $validator->errors());
        }

        // proses format harga
        $get_data_harga = explode(" ", $req->inputHarga);
        $harga = str_replace(".", "", $get_data_harga[1]);


        $params = [
            'id' => $id,
            'agen_id' => session('id'),
            'kode_barang' => $req->inputKodeBarang,
            'nama_barang' => $req->inputNamaBarang,
            'satuan' => $req->inputSatuan,
            'harga' => $harga,
            'stok' => $req->inputStok,
            'status' => 'pending',
        ];

        // $barangDB = Barang::where('kode_barang', $params['kode_barang'])
        //     ->orWhere('nama_barang', $params['nama_barang'])
        //     ->where('agen_id', $params['agen_id'])
        //     ->where('id','!=', $id)
        //     ->get();

        // $dataArray = json_decode(json_encode($barangDB), true);

        $barang = new Barang();
        $checkifExist = $barang->CheckDataBarangExist($params);
        $dataArray = json_decode(json_encode($checkifExist), true);

        if (sizeof($dataArray) == 0) {
            if ($updateBarang = Barang::find($id)->update($params)) {

                $response = [
                    'data' => $updateBarang,
                    'message' => 'Berhasil merubah data barang'
                ];

                return $this->responseOK($response, 200);
            } else {
                return $this->responseError('Gagal merubah silahkan coba lagi', 400);
            }
        } else {
            return $this->responseError('Kode barang atau nama barang sudah ada', 400);
        }
    }

    public function deleteBarang($id)
    {
        Barang::find($id)->delete();

        $response = [
            'message' => "Data berhasil dihapus!"
        ];

        return $this->responseOK($response, 200);
    }



    /** PENYALURAN BANTUAN DARI AGEN **/

    public function getListPenyaluran()
    {
        $penyaluran = new Penyaluran();
        $data = $penyaluran->getListData();

        return $this->responseOK($data);
    }


    public function getListAllPenerima()
    {
        $penerima = new Penerima();
        $data = $penerima->getListData();

        return $this->responseOK($data);
    }


    public function getListAllPenerimaByKeywords($keywords)
    {
        $penerima = new Penerima();
        $data = $penerima->getListDataByKeywords($keywords);

        return $this->responseOK($data);
    }

    public function addPenyaluran(Request $req)
    {
      
        $validator = Validator::make($req->all(), [
            'inputNamaPenerima' => ['required', 'string', 'max:255'],
            'nik_penerima' => ['required', 'string', 'max:255'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Gagal menambahkan silahkan isi data dengan benar!', 422, $validator->errors());
        }

        $barang_dipilih ='';

        if(isset($req->inputNamaBarang) && sizeof($req->inputNamaBarang) > 0){
            foreach ($req->inputNamaBarang as $k => $v){
                if($k == 0){
                    $barang_dipilih .= $v;
                }else{
                    $barang_dipilih .= ','.$v;
                }
            }
        }

        if(empty($barang_dipilih)){
            return $this->responseError('Barang untuk disalurkan belum tersedia', 400);
        }

        $penerima = new Penerima();
        $data = $penerima->getOneData($req);
        $penerima_db = json_decode(json_encode($data), true);
        date_default_timezone_set("Asia/Bangkok");

        $params = [
            'penerima_id' => $penerima_db[0]['id'],
            'nik' => $penerima_db[0]['nik'],
            'barang' => $barang_dipilih,
            'tgl_penyaluran' => date("Y-m-d H:i:s"),
            'status' => $req->status
        ];

        if ($addPenyaluran = Penyaluran::create($params)) {

            $response = [
                'data' => $addPenyaluran,
                'message' => 'Berhasil menyalurkan bantuan kepada '.$req->inputNamaPenerima
            ];

            return $this->responseOK($response, 200);
        } else {
            return $this->responseError('Gagal menambahkan silahkan coba lagi', 400);
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
