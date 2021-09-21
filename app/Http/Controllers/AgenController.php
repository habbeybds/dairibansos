<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\DinsosController;

class AgenController extends DinsosController
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

    public function pageDinsosAgen()
    {
        $data = $this->getListAgen()->getData();
        $dataArray = json_decode(json_encode($data), true);
        $results = $dataArray['data'];

        return view('managecp.dinsos.agen', compact('results'));
    }

    public function pageDinsosTambahAgen()
    {
        return view('managecp.dinsos.agen.add');
    }

    public function TambahAgen(Request $request)
    {
        $getData = $this->addAgen($request);

        if ($getData->getData()->code == 200) {
            $message = $getData->getData()->data->message;
            return redirect('agenlist')->with('toast_success', $message);
        } else {
            $message = $getData->getData()->error;
            return redirect('agenlist')->with('toast_error', $message);
        }
    }

    public function pageDinsosEditAgen($id)
    {
        $result = $this->getListAgenById($id)->getData();

        $data = json_decode(json_encode($result), true);

        $data['action'] = '/updateagen/' . $id;
        $data['method'] = 'POST';
        $data['nama_tombol'] = "Update";

        return view('managecp.dinsos.agen.edit', compact('data'));
    }


    public function UbahAgen(Request $request, $id)
    {

       $getData = $this->updateAgen($request, $id); 
      
       if($getData->getData()->code == 200){
           $message = $getData->getData()->data->message;
           return redirect('agenlist')->with('toast_success', $message);
       }else{
           $message = $getData->getData()->error;
           return redirect('agenlist')->with('toast_error', $message);
       }
    }

    public function pageDinsosDeleteAgen($id)
    {
        $getData = $this->deleteAgen($id); 
       
       if($getData->getData()->code == 200){
           $message = $getData->getData()->data->message;
           return redirect('agenlist')->with('toast_success', $message);
       }else{
           $message = $getData->getData()->error;
           return redirect('agenlist')->with('toast_error', $message);
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
