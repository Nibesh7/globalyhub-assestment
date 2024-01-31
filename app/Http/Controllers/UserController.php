<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $getFile =  Storage::disk('local')->get('assesment.csv');
        // $users = unserialize(($getFile));
        // return response()->json([
        //     'data' => $users,
        // ],200);
        $users = Storage::exists('data.json') ? json_decode(Storage::get('data.json'), true) : [];
        return response()->json([
            'data' => $users,
        ],200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|digits:10',
            'email' => 'email|required',
            'address' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }
       // Retrieve existing data from the CSV file, if it exists
    $existingData = Storage::exists('assesment.csv') ? unserialize(Storage::get('assesment.csv')) : [];

    // Add the new data to the existing data
    $data = [
        'name' => $request->name,
        'gender' => $request->gender ?? '-',
        'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
        'nationality' => $request->nationality ?? '-',
        'dob' => $request->dob ?? '-',
        'education' => $request->education ?? '-',
        'contact_mode' => $request->contact_mode ?? '-'
    ];
    // if($existingData){
    //     $allData = array_merge($existingData, $data);
    // }else{
    //     $allData = $data;
    // }

    // // Serialize and append the combined data to the CSV file
    // Storage::put('assesment.csv', serialize($allData));

    // Get the existing data if the file exists
    $existingData = Storage::exists('data.json') ? json_decode(Storage::get('data.json'), true) : [];
    $allData = [];
    // Append the new data to the existing data
    if($existingData){
        $allData = array_merge($existingData, [$data]);
    }else{
        $allData[] = $data;
    }

    // Store the data in the file
    Storage::put('data.json', json_encode($allData));


    return response()->json([
        'message' => 'User created successfully',
    ], 200);

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


}
