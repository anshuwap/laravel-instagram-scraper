@extends('layouts.archive.master')

@section('archive-content')

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="container pd-0">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>لیست پست ها</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><h5>پنل ادمین</h5></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Directory</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="contact-directory-list">
                <ul class="row">
                    @foreach ($posts as $id => $post)
                    <li class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="contact-directory-box">
                            <div class="contact-dire-info text-center">
                                <form action="">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="">
                                    </div>
                                </form>
                                <div class="contact-avatar">
                                    <span>
                                    <img src="" alt="" >
                                    </span>
                                </div>
                                <div class="contact-name">
                                    <h4></h4>
                                    <p></p>
                                    <div class="work text-success"><i class="ion-android-time"></i> </div>
                                </div>
                                <div class="contact-skill">
                                    <span class="badge badge-pill">like :</span>
                                    <span class="badge badge-pill">view :</span>
                                    <span class="badge badge-pill">comment :</span>
                                </div>
                                
                            </div>
                            <div class="contact-skill text-center">
                                <a href=""><button type="button" class="btn btn-outline-danger btn-sm">Remove</button></a>
                            </div>
                            <div class="view-contact">
                                <a href="">مشاهده</a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div>
                    {{$posts->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection