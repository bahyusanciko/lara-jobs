<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataJob = Job::select('jobs.*','users.name')->join('users','users.id','=','jobs.created_by')->get();
        $data =  [
            'jobsList' => $dataJob
        ];

        return view('home',$data);
    }
}
