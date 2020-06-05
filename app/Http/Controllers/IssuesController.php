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
    public function index()
    {
        //TODO :make a page for displaying all issues ..
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('issues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|required',
            'device_id' => 'required'
        ]);

        $data['device_id'] = $request['device_id'];
        $issue = Issue::create($data);
        $device = Device::findOrFail($data['device_id']);
        $issues = $device->issues()->paginate(5);
        if($issue){
            return redirect(
              route('device.show',compact('device', 'issues'))
            )->withStatus('Issue created successfully');
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
    public function destroy(Issue $issue)
    {
        $device = $issue->device;
        $issue->delete();
        return redirect(
            route('device.show', compact('device'))
        )->withStatus( __('Issue deleted successfully'));
    }




    public function resolveIssue(Issue $issue){
        $issue->resolve();
        return redirect(route('device.show', $issue->device))->withStatus(__('Issue resolved successfully'));
    }


    public function retreatIssue(Issue $issue){
        $issue->retreat();
        return redirect(route('device.show', $issue->device))->withStatus(__('Issue retreated successfully'));
    }
}