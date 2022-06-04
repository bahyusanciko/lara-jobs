@extends('layouts.app')
<style>
    .list-img {
        width: 400px;
        height: 200px;
    }

    .modal-img {
        width: 410px;
        height: 610px;
    }

</style>
@section('content')
<div class="container">
    <h1 class="text-center">List Jobs</h1>
    <div class="row justify-content-center">
        @foreach ($jobsList as $item)
        <div class="col-3 p-1 m-1">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top list-img" src="{{asset("image/$item->img")}}" alt="{{$item->img}}">
                <div class="card-body">
                    <span>{{$item->name}}</span>
                    <h5 class="card-title">{{$item->title}}</h5>
                        <a href="#" class="btn btn-primary btn-block" onclick="showJobs({{json_encode($item)}})">Apply</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalJobs" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="row">
                <div class="col-12" id="modalResultJobs"></div>
                <div class="col-12">
                    <form class="container" id="createapplyjobs" action="{{ url('/applyjobs') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_jobs" id="id_jobs">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="number" name="phone" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor WA</label>
                                    <input type="number" name="wa" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
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
    function showJobs(arr) {
        $('#modalResultJobs').html('')
        $("#modalJobs").modal('show');
        let url = `{{asset('image')}}` + '/' + arr.img;
        $('#id_jobs').val(arr.id);
        $('#modalResultJobs').html(`
            <div class="card">
                <img class="card-img-top modal-img" src="${url}" alt="${arr.img}">
                <div class="card-body">
                    <span>${arr.name}</span>
                    <h5 class="card-title">${arr.title}</h5>
                    <p class="card-text">${arr.description}</p>
                </div>
            </div>
        `);
    }
    $(function () {
        $("#createapplyjobs").submit(function (e) {
            e.preventDefault();
            $('#preloader').show()
            $("#modalJobs").modal('hide');
            this.submit(); //declare `$form as a local variable by using var $form = this;
        });
    });

</script>
@endpush
