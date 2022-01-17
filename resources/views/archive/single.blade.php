@extends('layouts.archive.master')

@section('archive-content')

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="container pd-0">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>تبلیغات پیج {{$post->owner}}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><h5>پنل ادمین</h5></a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="contact-directory-list">
                @include('errors.msg')
                
                   
            </div>
        </div>
    </div>
</div>

@endsection