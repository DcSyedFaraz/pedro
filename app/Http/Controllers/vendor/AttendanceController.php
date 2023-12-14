<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AttendanceController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('map');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $data = $request->all();

        // dd($data['longitude']);
        $client = new Client();

        $response = $client->get('https://api.opencagedata.com/geocode/v1/json', [
            'query' => [
                'key' => 'ab5facf267b84f5ba20bace2281864a1',
                'q' => "{$data['latitude']},{$data['longitude']}",
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if($data['total_results'] > 0) {
            return $data['results'][0]['formatted'];
        }

        return [
            'success' => false,
            'message' => 'No location found for the provided coordinates.',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
