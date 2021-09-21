<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NomorSK;
use App\Models\JenisBantuan;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Penerima;
use App\Models\Barang;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Print_;
use Importer;

class DinsosController extends BaseController
{

    /* NOMOR SK */
    public function getTahapanBySKdanJabatan($jenisbantuanid)
    {
        $getNomorSK = new NomorSK();
        $data = $getNomorSK->checkTahapanBySKJB($jenisbantuanid);

        return $this->responseOK($data);
    }
    public function validateDatabyNomorSKJB($nomorSK, $jenisbantuanid)
    {
        $getNomorSK = new NomorSK();
        $data = $getNomorSK->getListDatabyNoSK($nomorSK, $jenisbantuanid);

        return $this->responseOK($data);
    }

    /* JENIS BANTUAN */
    public function getListJenisBantuan()
    {
        $jenisbantuan = new JenisBantuan();
        $data = $jenisbantuan->getListData();

        return $this->responseOK($data);
    }

    public function getListJenisBantuanById($id)
    {
        $data = JenisBantuan::findOrFail($id);

        return $this->responseOK($data);
    }

    public function addJenisBantuan(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'jenis_bantuan' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Gagal menambahkan silahkan isi data dengan benar!', 422, $validator->errors());
        }

        $params = [
            'jenis_bantuan' => $req->jenis_bantuan,
            'jumlah_tahapan' => '12',
            'tahun_tahapan' => '2021',
        ];
        $jenisbantuanDB = JenisBantuan::where('jenis_bantuan', $params['jenis_bantuan'])->get();
        $dataArray = json_decode(json_encode($jenisbantuanDB), true);

        if (sizeof($dataArray) == 0) {
            if ($addjenisbantuan = JenisBantuan::create($params)) {

                $response = [
                    'data' => $addjenisbantuan,
                    'message' => 'Berhasil menambah Jenis Bansos'
                ];

                return $this->responseOK($response, 200);
            } else {
                return $this->responseError('Gagal menambahkan silahkan coba lagi', 400);
            }
        } else {
            return $this->responseError('Data Jenis Bantuan sudah ada', 400);
        }
    }

    public function updateJenisBantuan(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'jenis_bantuan' => ['required', 'string', 'max:255'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Gagal merubah silahkan isi data dengan benar!', 422, $validator->errors());
        }

        try {
            JenisBantuan::find($id)->update($req->all());

            $response = [
                'message' => "Berhasil merubah data Jenis Bantuan"
            ];

            return $this->responseOK($response, 200);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return $this->responseError('Jenis Bantuan Sudah ada data silahkan input data lain', 400);
            }
        }

        return $this->responseError('Gagal merubah silahkan coba lagi', 400);
    }

    public function deleteJenisBantuan($id)
    {
        JenisBantuan::find($id)->delete();

        $response = [
            'message' => "Data berhasil dihapus!"
        ];

        return $this->responseOK($response, 200);
    }

    /* END JENIS BANTUAN */

    /* DESA */
    public function getListDesa()
    {
        $desa = new Desa();
        $data = $desa->getListData();
        return $this->responseOK($data);
    }

    public function getListKecamatan()
    {
        $kecamatan = new Kecamatan();
        $data = $kecamatan->getListData();
        return $this->responseOK($data);
    }

    public function getListDesaById($id)
    {

        $data = Desa::findOrFail($id);

        return $this->responseOK($data);
    }

    public function addDesa(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'inputKecamatan' => ['required', 'string', 'max:255'],
            'inputDesa' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Gagal menambahkan silahkan isi data dengan benar!', 422, $validator->errors());
        }

        $params = [
            'kecamatanid' => $req->inputKecamatan,
            'desa' => $req->inputDesa,
        ];
        $desaDB = Desa::where('desa', $params['desa'])->get();
        $dataArray = json_decode(json_encode($desaDB), true);

        if (sizeof($dataArray) == 0) {
            if ($addDesa = Desa::create($params)) {

                $response = [
                    'data' => $addDesa,
                    'message' => 'Berhasil menambah Desa'
                ];

                return $this->responseOK($response, 200);
            } else {
                return $this->responseError('Gagal menambahkan silahkan coba lagi', 400);
            }
        } else {
            return $this->responseError('Data Desa sudah ada', 400);
        }
    }

    public function updateDesa(Request $req, $id)
    {

        $validator = Validator::make($req->all(), [
            'inputKecamatan' => ['required', 'string', 'max:255'],
            'inputDesa' => ['required', 'string', 'max:255'],
            'status' => ['required'],
        ]);


        if ($validator->fails()) {
            return $this->responseError('Gagal merubah silahkan isi data dengan benar!', 422, $validator->errors());
        }

        $params = [
            'kecamatanid' => $req->inputKecamatan,
            'desa' => $req->inputDesa,
            'status' => $req->status,
        ];

        // $desaDB = Desa::where('desa', $params['desa'])->where('kecamatanid', $params['kecamatanid'])->get();
        // $dataArray = json_decode(json_encode($desaDB), true);

        $getDatabyID = Desa::find($id);

        try {

            Desa::find($id)->update($params);

            $response = [
                'message' => "Berhasil merubah desa"
            ];

            return $this->responseOK($response, 200);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {

                return $this->responseError('Desa Sudah ada data silahkan input desa lain', 400);
            }
        }

        return $this->responseError('Gagal merubah silahkan coba lagi', 400);
    }

    public function deleteDesa($id)
    {
        Desa::find($id)->delete();

        $response = [
            'message' => "Data berhasil dihapus!"
        ];

        return $this->responseOK($response, 200);
    }
    /* END DESA */


    /* AGEN */
    public function getListAgen()
    {
        $agen = new User();
        $data = $agen->getListDataAgen();
        return $this->responseOK($data);
    }

    public function getListAgenById($id)
    {
        $data = User::where('usergroupid', '2')->findOrFail($id);

        return $this->responseOK($data);
    }

    public function addAgen(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'inputFirstName' => ['required', 'string', 'max:255'],
            'inputLastName' => ['required', 'string', 'max:255'],
            'inputNoHP' => ['required', 'string', 'min:10', 'max:13'],
            'inputUsername' => ['required', 'string', 'min:8', 'max:255'],
            'inputEmail' => ['required', 'string', 'email', 'max:255'],
            'inputPassword' => ['required', 'string', 'min:8'],
            'inputPasswordConfirmation' => ['required', 'string', 'min:8'],
        ]);


        if ($validator->fails()) {
            return $this->responseError('Gagal menambahkan silahkan isi data dengan benar!', 422, $validator->errors());
        }


        $params = [
            'usergroupid' => '2',
            'first_name' => $req->inputFirstName,
            'last_name' => $req->inputLastName,
            'username' => $req->inputUsername,
            'email' => $req->inputEmail,
            'email_verified_at' => now(),
            'no_hp' => $req->inputNoHP,
            'password' =>  Hash::make($req->inputPassword),
        ];


        $checkExist = User::where('usergroupid', '2')->where('email', $params['email'])->orWhere('username', $params['username'])->get();
        $dataArray = json_decode(json_encode($checkExist), true);



        if (sizeof($dataArray) == 0) {
            if ($addAgen = User::create($params)) {

                $token = $addAgen->createToken('MyToken')->accessToken;

                $response = [
                    'data' => $addAgen,
                    'token' => $token,
                    'message' => 'Berhasil menambah Agen'
                ];


                return $this->responseOK($response, 200);
            } else {
                return $this->responseError('Gagal menambahkan silahkan coba lagi', 400);
            }
        } else {
            return $this->responseError('Username atau email sudah digunakan', 400);
        }
    }

    public function updateAgen(Request $req, $id)
    {

        $validator = Validator::make($req->all(), [
            'inputFirstName' => ['required', 'string', 'max:255'],
            'inputLastName' => ['required', 'string', 'max:255'],
            'inputNoHP' => ['required', 'string', 'min:10', 'max:13'],
            'inputUsername' => ['required', 'string', 'min:8', 'max:255'],
            'inputEmail' => ['required', 'string', 'email', 'max:255'],
        ]);


        if ($validator->fails()) {
            return $this->responseError('Gagal merubah silahkan isi data dengan benar!', 422, $validator->errors());
        }

        $params = [
            'first_name' => $req->inputFirstName,
            'last_name' => $req->inputLastName,
            'username' => $req->inputUsername,
            'email' => $req->inputEmail,
            'no_hp' => $req->inputNoHP,
            'status' => $req->status,
        ];

        if (!empty($req->inputPassword)) {
            $params['password'] = Hash::make($req->inputPassword);
        }

        try {
            User::find($id)->update($params);

            $response = [
                'message' => "Berhasil merubah data Agen"
            ];

            return $this->responseOK($response, 200);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return $this->responseError('Duplicate Entry username or email', 400);
            }
        }

        return $this->responseError('Gagal merubah silahkan coba lagi', 400);
    }

    public function deleteAgen($id)
    {
        User::find($id)->delete();

        $response = [
            'message' => "Data berhasil dihapus!"
        ];

        return $this->responseOK($response, 200);
    }
    /* END AGEN */

    /* PENERIMA */
    public function getListPenerima()
    {
        $penerima = new Penerima();
        $data = $penerima->getListData();

        return $this->responseOK($data);
    }

    public function getDesaByKecamatan()
    {
        if ($_POST['action'] == "getDataDesa") {
            $kecamatan_id = $_POST['data'];

            $desa = new Desa();
            $data = $desa->getListDesaByKecamatanID($kecamatan_id);
            echo json_encode($data);
            exit;
        }
    }

    public function importDataPenerima(Request $req)
    {


        $validate = "false";
        $validator = Validator::make($req->all(), [
            'uploadDataPenerima' => 'required|mimes:xls,xlsx',
            'inputNoSK' => ['required', 'string'],
            'inputJenisBantuan' => ['required', 'string'],
            'inputKecamatan' => ['required', 'string'],
            'inputDesa' => ['required', 'string'],
        ]);


        if ($validator->fails()) {
            return $this->responseError('Data Upload harus berupa Excel (xls,xlsx)', 422, $validator->errors());
        }

        /* PROCESS NOMOR SK */
        //$results_nomor_SK = [];
        $validateDataNoSK = $this->validateDatabyNomorSKJB($req->inputNoSK, $req->inputJenisBantuan)->getData();
        $dataArrayValidate = json_decode(json_encode($validateDataNoSK), true);
        $results_validate = $dataArrayValidate['data'];


        if (empty($results_validate)) {

            $checkTahapan = $this->getTahapanBySKdanJabatan($req->inputJenisBantuan)->getData();
            $dataArray = json_decode(json_encode($checkTahapan), true);
            $results_tahapan = $dataArray['data'];
            $tahapan = 0;

            if (empty($results_tahapan)) {
                $tahapan = 1;
            } else {
                $tahapan = $results_tahapan['tahapan'] + 1;
            }

            $path = $req->file('uploadDataPenerima')->getRealPath();
            $excel = Importer::make('Excel');
            $excel->load($path);
            $excel->setSheet(1);
            $collection = $excel->getCollection();

            $data_penerima = [];

            if (!empty($collection) && $collection->count() > 0) {
                $arr_collection = $collection->toArray();
                $collaction_arr = array_shift($arr_collection);

                foreach ($arr_collection as $key => $value) {

                    $value[16] = '';
                    $value[17] = $req->inputDesa;
                    $value[18] = $req->inputJenisBantuan;

                    $insert_data = [
                        'no_skid' => $value[16],
                        'nik' => $value[0],
                        'no_kk' => $value[1],
                        'name' => $value[2],
                        'alamat' => $value[3],
                        'desaid' => $value[17],
                        'jenis_kelamin' => $value[4],
                        'pekerjaan' => $value[5],
                        'status_kawin' => $value[6],
                        'dtks' => $value[7],
                        'dtks2_kk' => $value[8],
                        'jenisbantuanid' => $value[18],
                        'nominal_bantuan' => $value[13],
                    ];

                    array_push($data_penerima, $insert_data);
                }

            }
            
            $data = [
                'nomor_sk' => $req->inputNoSK,
                'jenisbantuan_id' => $req->inputJenisBantuan,
                'tahapan' => $tahapan,
                'penerima' => $data_penerima,
            ];

            return $this->responseOK($data);

        } else {
            return $this->responseError('Nomor SK di Jenis Bantuan Tersebut sudah ada', 422);
        }

        /*END PROCESS NOMOR SK */
    }

    /* SETUJUI BARANG DI ADMIN DINSOS */
    public function getListSetujuiBarang()
    {
        $barang = new Barang();
        $data = $barang->getListDataPending();

        return $this->responseOK($data);
    }

    public function getListDiSetujuiBarang()
    {
        $barang = new Barang();
        $data = $barang->getListDataApproved();

        return $this->responseOK($data);
    }

    public function approveBarang($id)
    {
        $params = [
            'status' => 'approved',
        ];
        
        if(Barang::find($id)->update($params)){
            
            $barang = new Barang();
            $data = $barang->getOneDataApproved($id);

            if(!empty($data)){
                return $this->responseOK($data);
            }else{
                return $this->responseError('Tidak ada data barang', 401);
            }
        }else{
            return $this->responseError('Gagal Menyetujui Barang', 422);
        }
        
    }
    public function cancelledBarang($id)
    {
        $params = [
            'status' => 'cancelled',
        ];
        
        if(Barang::find($id)->update($params)){
            
            $barang = new Barang();
            $data = $barang->getOneDataCancelled($id);

            if(!empty($data)){
                return $this->responseOK($data);
            }else{
                return $this->responseError('Tidak ada data barang', 401);
            }
        }else{
            return $this->responseError('Gagal Menyetujui Barang', 422);
        }
        
    }

    /* END PENERIMA */
}
