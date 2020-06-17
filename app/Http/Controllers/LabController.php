<?php

namespace App\Http\Controllers;

use App\Lab;
use App\Device;
use App\Issue;
use Illuminate\Http\Request;
use App\Http\Requests\LabRequest;
use Illuminate\Support\Facades\Storage;


class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Lab $model)
    {
      return view('labs.index', ['labs' => $model->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabRequest $request, Lab $model)
    {
        if($request->hasFile('program') && $request->file('program')->isValid()){
            $input = $request->all();
            $input['program'] = $request->program->store('programs');
            $model->create($input);
            return redirect()->route('lab.index')->withStatus(__('Lab successfully created.'));
        }

        $model->create($request->all());
        return redirect()->route('lab.index')->withStatus(__('Lab successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab)
    {
        $devices = $lab->devices()->paginate(5);
        return view('labs.show', ['lab' => $lab, 'devices' => $devices]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        return view('labs.edit', compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LabRequest $request, Lab $lab)
    {
         if($request->hasFile('program') && $request->file('program')->isValid()){
             if(Storage::exists($lab->program)){
                 Storage::delete($lab->program);
             }
            $input = $request->all();
            $input['program']=$request->program->store('programs');
            $lab->update($input);
            return redirect()->route('lab.index')->withStatus(__('Lab successfully updated.'));
        }

        $lab->update($request->all());
        return redirect()->route('lab.index')->withStatus(__('Lab successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        if($lab->program){
            Storage::delete($lab->program);
        }
        $lab->delete();
        return redirect()->route('lab.index')->withStatus(__('Lab successfully deleted.'));
    }


    public function getProgram(Lab $lab){
        if(Storage::exists($lab->program)){
            return Storage::download($lab->program);
        }else{
            abort(404);
        }
    }


    public function labQR(Lab $lab){
        $code = \QrCode::size(300)->generate( Route('api.devices', $lab) );
        return view('labs.qrCode', ['code' =>$code, 'name' => $lab->name]);
    }



}