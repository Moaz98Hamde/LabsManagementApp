<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lab;
use App\Device;
use App\Issue;

class ApiController extends Controller
{
    public function allLabs(){
        return response()->json(['status' => 'success', 'data' => Lab::all()], 200);
    }


    public function allLabDevices(Lab $lab){
        $devices = $lab->devices;

        return response()->json(['status' => 'success', 'data' => $devices], 200);
    }


    public function device(Lab $lab, Device $device){
        $device = $lab->devices()->findOrFail($device->id);
        return response()->json(['status' => 'success', 'data' => $device->first()], 200);
    }

    public function deviceIssues(Lab $lab, Device $device){
        $device = $lab->devices()->findOrFail($device->id);
        return response()->json(['status' => 'success', 'data' => $device->first()->issues], 200);
    }


    public function newIssue(Request $request, Lab $lab, Device $device){
        $device = $lab->devices()->findOrFail($device->id);
        $device = $device->first();

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);

       $done =  $device->issues()->save(Issue::create($request->all()));

       if($done){
            return response()->json(['status' => 'success', 'message' => 'issue submitted successfully'], 201);
       }else{
           return response()->json(['status' => 'error', 'message' => 'Something went wrong!'], 500);
       }
    }
}