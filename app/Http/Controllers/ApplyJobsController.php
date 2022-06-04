<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplyJob;
use Session;

class ApplyJobsController extends Controller
{
    public function index()
    {
        $listApplyJob = ApplyJob::select('apply_jobs.*','jobs.title')
        ->join('jobs', 'jobs.id', '=', 'apply_jobs.id_job')
            ->get();
        return view('applyjobs.index', compact('listApplyJob'));
    }

    public function store(Request $request)
    {
        $applyJob = new ApplyJob();
        $applyJob->id_job = $request->id_jobs;
        $applyJob->name = $request->name;
        $applyJob->wa = $request->wa;
        $applyJob->phone = $request->phone;
        $applyJob->save();
        Session::flash('swall', "Swal.fire('Good job!','Apply Job has been added','success');");
        return redirect()->back();
    }
}
