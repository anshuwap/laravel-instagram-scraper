@extends('layouts.scrap-page.master')

@section('scrap-page-content')
<section class="content" style="padding: 1em 1.5rem;">
    <div class="container-fluid">
        @include('errors.msg')
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">فعال کردن ربات اسکراپر</h3>
            </div>
            <form action="{{ route('start.scrap') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">فایل اکسل را انتخاب کنید</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="pagesFile" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">فایل اکسل را انتخاب کنید</label>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>روبات ها را انتخاب کنید</label>
                                <select class="select2bs4" name="select-robot[]" multiple data-placeholder="Select a State" style="width: 100%;">
                                @foreach($robots as $robot)
                                    <option value="{{ $robot->id }}">{{ $robot->username }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">ارسال</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection 

