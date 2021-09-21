<?php

namespace App\Http\Controllers\agen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AgenController;

class BarangController extends AgenController
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

    public function pageAgenBarang()
    {
        $data = $this->getListBarang(session('id'))->getData();
        
        $dataArray = json_decode(json_encode($data), true);
        $results = $dataArray['data'];

        return view('managecp.agen.barang', compact('results'));
    }

    public function pageDinsosTambahBarang()
    {
        $satuan_barang = ['kg','pcs','box','bks','ltr','lusin'];

        return view('managecp.agen.barang.add', compact('satuan_barang'));
    }

    public function TambahBarang(Request $req)
    {
        $getData = $this->addBarang($req);

        if($getData->getData()->code == 200){
            $message = $getData->getData()->data->message;
            return redirect('baranglist')->with('toast_success', $message);
        }else{
            $message = $getData->getData()->error;
            return redirect('baranglist')->with('toast_error', $message);
        }
    }

    public function pageDinsosEditBarang($id)
    {
        $result = $this->getListBarangById($id)->getData();
        
        $data = json_decode(json_encode($result), true);
        
        $data['data']['harga']= 'Rp. '.number_format($data['data']['harga'],0,',','.');
        $data['action']='/updatebarang/'.$id;
        $data['method']='POST';
        $data['satuan_barang']= ['kg','pcs','box','bks','ltr','lusin'];
        $data['nama_tombol'] = "Update";

        return view('managecp.agen.barang.edit', compact('data'));
    }

    public function UbahBarang(Request $request, $id)
    {

       $getData = $this->updateBarang($request, $id); 
      
       if($getData->getData()->code == 200){
           $message = $getData->getData()->data->message;
           return redirect('baranglist')->with('toast_success', $message);
       }else{
           $message = $getData->getData()->error;
           return redirect('baranglist')->with('toast_error', $message);
       }
    }

    public function pageDinsosDeleteBarang($id)
    {
        $getData = $this->deleteBarang($id); 
       
        if($getData->getData()->code == 200){
            $message = $getData->getData()->data->message;
            return redirect('baranglist')->with('toast_success', $message);
        }else{
            $message = $getData->getData()->error;
            return redirect('baranglist')->with('toast_error', $message);
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
