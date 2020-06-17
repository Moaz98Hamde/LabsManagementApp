<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Device;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Device $device)
    {
        //TODO :make a page for displaying all issues ..
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Device $device)
    {
         return view('issues.create', compact('device'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Device $device)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|required',
        ]);

        $issue = Issue::create($data);
        $issue->device()->associate($device);
        $issue->save();

        if($issue){
            return redirect( route('lab.device.show', ['lab' => $device->lab, 'device' => $device]) )
            ->withStatus('Issue created successfully');
        }else{
            return abort(500);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device, Issue $issue)
    {
        $issue->delete();
        return redirect(
            route('lab.device.show', ['lab' => $device->lab, 'device' => $device])
        )->withStatus( __('Issue deleted successfully'));
    }




    public function resolveIssue(Issue $issue){
        $issue->resolve();
        return redirect( route('lab.device.show', ['lab' => $issue->device->lab, 'device' => $issue->device] ) )
        ->withStatus(__('Issue resolved successfully'));
    }


    public function retreatIssue(Device $device, Issue $issue){
        $issue->retreat();
        return redirect( route('lab.device.show', ['lab' => $issue->device->lab, 'device' => $issue->device]) )
        ->withStatus(__('Issue retreated successfully'));
    }
}