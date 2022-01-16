@extends('layouts.scrap-page.master')

@section('scrap-page-content')
<section class="content" style="padding: 1em 1.5rem;">
    <div class="container-fluid">
        @include('errors.msg')
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">افزودن پروکسی ها</h3>
            </div>
            <form action="{{ route('proxies.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">فایل اکسل حاوی پروکسی ها را انتخاب کنید</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="proxiesFile" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">فایل اکسل را انتخاب کنید</label>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">افزودن</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection 

