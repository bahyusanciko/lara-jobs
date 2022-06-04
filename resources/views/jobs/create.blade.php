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
                    </a>Create Jobs
                </div>
                <div class="card-body">

                    <form id="createjobs" action="{{ url('/jobs') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                         
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="title" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image </label>
                                    <input type="file" accept="image/apng, image/avif, image/gif, image/jpeg, image/png, image/svg+xml, image/webp" name="img" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Decsription</label>
                                    <textarea class="form-control" required name="description" name="description"
                                        cols="10" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    $(function () {
        $("#createjobs").submit(function (e) {
            e.preventDefault();
            $('#preloader').hide()
            Swal.fire({
                title: 'Do you want to save the create?',
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
