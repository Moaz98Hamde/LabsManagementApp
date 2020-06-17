<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Lab;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Lab $lab)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Lab $lab)
    {
        return view('devices.create', compact('lab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lab $lab)
    {
        $request->validate(['description' => 'required']);
        $device = Device::create($request->all());
        $device->lab()->associate($lab);
        $device->save();

        if($device){
            return redirect( route('lab.show', $lab) )->withStatus(__('Device successfully created.'));
        }else{
            abort(500, 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab, Device $device)
    {
        $issues = $device->issues()->paginate(5);
        return view('devices.showIssues', ['device' => $device, 'issues' => $issues]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab, Device $device)
    {
        $device->delete();
        return redirect( route('lab.show', $lab) )->withStatus(__('Device successfully deleted.'));

    }



    public function createIssue(Device $device){
        return view('issues.create', compact('device'));
    }
}