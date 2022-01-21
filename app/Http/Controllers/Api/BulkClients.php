<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class BulkClients extends Controller
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
    public function upload($request)
    {

        if ($request->hasFile('img')) {
            if ($_FILES['img']['error']) {
                # code...
                return false;
            } else {
                $extension = $request->file('img')->getClientOriginalExtension();

                $fileNameToStore = Str::random(10) . '_' . time() . '.' . $extension;

                $path = $request->file('img')->storeAs('public', $fileNameToStore);
                return $fileNameToStore;
            }
        } else {
            return false;
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
        // return $_FILES;s
        $s = $this->upload($request);
        // return $s;s
        // return '/app/'+$
        $filename = storage_path('app/public/'.$s);
        $file = fopen($filename, "r");
        $all_data = array();
        // return $all_data;
        while ( ($data = fgetcsv($file, 200, ",")) !==FALSE ) {
            $name = $data[0];
            $city = $data[1];

            Clients::create([
                'name' => $data[0],
                'email' =>  $data[3],
                'tel' =>  $data[1]
            ]);
        }
       
        return 'done';

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
