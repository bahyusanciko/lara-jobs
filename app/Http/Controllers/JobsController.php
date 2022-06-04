<?php

namespace App\Http\Controllers;

use Image;
use Session;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class JobsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataJob = Job::select('jobs.*','users.name')->join('users','users.id','=','jobs.created_by')->get();
        $data =  [
            'jobsList' => $dataJob
        ];
        return view('jobs.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');
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
            'title'       => 'required',
            'description' => 'required',
            'img'         => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('swall', "Swal.fire('Check!','Your Input','error');");
            return Redirect::to('jobs')
                ->withErrors($validator);
        } else {
            $createJob = array_filter($request->all());
            $createJob['created_by'] = auth()->user()->id;
            $image = $request->file('img');
            if ($image) {
                $imageName = uniqid().date('Y-m-d-H:i:s').".".$image->extension();
                $destinationPath = public_path('image');
                // $img = Image::make($image->path());
                $image->move($destinationPath, $imageName);
                $createJob['img'] = $imageName;
            }
            Job::create($createJob);
            Session::flash('swall', "Swal.fire('Good job!','Job create','success');");
            return Redirect::to('jobs');   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Redirect::to('jobs');   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataJob = Job::find($id);
        $data =  [
            'jobs' => $dataJob
        ];
        return view('jobs.edit',$data);
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
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('swall', "Swal.fire('Check!','Your Input','error');");
            return Redirect::to('jobs/'.$id.'/edit')
                ->withErrors($validator);
        } else {
            $updateJob = array_filter($request->all());
            $image = $request->file('img');
            if ($image) {
                $imageName = uniqid().date('Y-m-d-H:i:s').".".$image->extension();
                $destinationPath = public_path('image');
                // $img = Image::make($image->path());
                $image->move($destinationPath, $imageName);
                $updateJob['img'] = $imageName;
            }
            $updateJob['created_by'] = auth()->user()->id;
            unset($updateJob['_method']);
            unset($updateJob['_token']);
            Job::where('id',$id)->update($updateJob);
            Session::flash('swall', "Swal.fire('Good job!','Job update','success');");
            return Redirect::to('jobs');   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteJob = Job::find($id);
        $deleteJob->delete();
        Session::flash('swall', "Swal.fire('Good job!','Job delete','success');");
        return Redirect::to('jobs');   
    }
}
