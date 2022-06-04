@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-12">
            <div class="card">
                <div class="card-header">List Apply Jobs
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">No. Phone</th>
                                <th scope="col">No. WA</th>
                                <th scope="col">Jobs</th>
                                <th scope="col">Created At</th>                            </tr>
                        </thead>
                        <tbody class="jobss">
                            @foreach($listApplyJob as $item)
                            <tr id="{{$item->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->wa}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection