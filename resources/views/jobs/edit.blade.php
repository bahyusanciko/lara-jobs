@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-12">
            <div class="card">
                <div class="card-header"> <a href="{{url('jobs')}}">
                        <button type="button" class="btn btn-large btn-info btn-rounded btn-icon" data-toggle="tooltip"
                            data-placement="top" title="Create jobs"> <i class="fas fa-arrow-left"></i>
                        </button>
                    </a>Edit Jobs
                </div>
                <div class="card-body">
                    <form id="editjobs" action="{{url("jobs/$jobs->id")}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{$jobs->title}}" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image  <i onclick="imgjobs(`{{$jobs->img}}`)" class="fas fa-image"></i></label>
                                    <input type="file" accept="image/apng, image/avif, image/gif, image/jpeg, image/png, image/svg+xml, image/webp" name="img" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Decsription</label>
                                    <textarea class="form-control" required name="description" name="description"
                                        cols="10" rows="10">{{$jobs->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
    $(function () {
        $("#editjobs").submit(function (e) {
            e.preventDefault();
            $('#preloader').hide()
            Swal.fire({
                title: 'Do you want to save the edit?',
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
                    this
                        .submit(); //declare `$form as a local variable by using var $form = this;
                } else if (result.isDenied) {
                    return false
                }
            })
        });
    });

</script>
@endpush
