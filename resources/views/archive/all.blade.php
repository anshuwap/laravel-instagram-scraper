@extends('layouts.archive.master')

@section('archive-content')

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="container-parent pd-0">
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
                @include('errors.msg')
                <form action="{{ route('posts.daleteAll') }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" style="font-family: Vazir; margin-bottom: 1em;" class="btn btn-danger">حذف همه</button>
                    <ul class="row">
                        @foreach ($posts as $id => $post)
                        <li class="col-xl-4 col-lg-4 col-md-6 col-sm-12" style="font-family: Vazir;margin-top: 0.5em;">
                            <div class="contact-directory-box">
                                <input type='checkbox' name='delete[]' value="{{ $post->id }}">
                                <div class="contact-dire-info text-center">
                                    <div class="contact-avatar">
                                        <span>
                                        <img src="/uploads/{{ $post->thumbnail_url }}" alt="تصویر کاور" >
                                        </span>
                                    </div>
                                    <div class="contact-name">
                                        <h5>{{ $post->owner }}</h5>
                                        <p>{{ $post->tag }}</p>
                                        <div style="padding: 5px;" class="work text-success"><i class="ion-android-time"></i> در مدت زمان : {{ \App\Utilities\TimerPosts::timer($post->date) }}</div>
                                        <div class="work text-warning"><i class="ion-android-calendar"></i> گرفته شده در  : {{ strtok($post->created_at ,' ') }}</div>
                                    </div>
                                    <div class="contact-skill">
                                        <span style="display: block;" class="badge badge-pill">like : {{ $post->like }}</span>
                                        <span style="display: block;" class="badge badge-pill">view : {{ $post->view }}</span>
                                        <span style="display: block;" class="badge badge-pill">comment : {{ $post->comment }}</span>
                                    </div>
                                    
                                </div>
                                <div class="view-contact">
                                    <a href="{{ route('posts.single', $post->id) }}">مشاهده</a>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div>
                        {{$posts->links('pagination::bootstrap-4')}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection