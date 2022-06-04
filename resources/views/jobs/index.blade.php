@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-12">
            <div class="card">
                <div class="card-header">List Jobs
                    <a href="{{url('jobs/create')}}">
                        <button type="button" class="btn btn-large btn-info btn-rounded btn-icon" data-toggle="tooltip"
                            data-placement="top" title="Create jobs"> <i class="fas fa-plus"></i>
                        </button>
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Img</th>
                                <th scope="col">Created</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="jobss">
                            @foreach($jobsList as $item)
                            <tr id="{{$item->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$item->title}}</td>
                                <td>{{substr($item->description,0,30)}}</td>
                                <td><i onclick="imgjobs(`{{$item->img}}`)" class="fas fa-image"></i></td>
                                <td>{{$item->name}}</td>
                                <td> <button type="button" class="btn btn-small btn-warning btn-rounded btn-icon"
                                        onclick="editjobs({{$item->id}})" data-toggle="tooltip" data-placement="top"
                                        title="Edit jobs">
                                        <i class="fas fa-edit"></i> </button> | <button type="button"
                                        class="btn btn-small btn-danger btn-rounded btn-icon"
                                        onclick="deletejobs({{$item->id}})" data-toggle="tooltip"
                                        data-placement="top" title="Delete jobs">
                                        <i class="fas fa-trash-alt"></i> </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<form id="deletejobs" method="POST" action="/admin/users/">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
<div class="modal fade bd-example-modal-lg" id="modalImage" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" id="modalResult" src="" allowfullscreen></iframe>
            </div>

        </div>
    </div>
</div>

@endsection
@push('js')
<script>
     function imgjobs(val) {
        $("#modalImage").modal('show');
        let url = `{{asset('image')}}` + '/' + val;
        $("#modalResult").attr("src", url);
    }
    function deletejobs(dataId) {
        Swal.fire({
            title: 'Do you want to deleted?',
            showDenyButton: true,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'alert-submit',
                confirmButton: 'order-1',
                denyButton: 'order-2',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#preloader').show()
                $('#deletejobs').attr('action', "{{url('jobs')}}/"+dataId).submit();
            } else if (result.isDenied) {
                return false
            }
        })
    }

    function editjobs(dataId) {
        window.location.href = "{{url('jobs/')}}/" + dataId + "/edit";
    };

</script>

@endpush
