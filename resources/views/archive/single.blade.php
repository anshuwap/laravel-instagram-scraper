@extends('layouts.single.master')

@section('single-content')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="container-parent pd-0">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="title">
                                <h4 style="direction: rtl;">تبلیغات پیج {{$post->owner}}</h4>
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
                    
                    <div class="product-wrap">
                        <div class="product-detail-wrap mb-30"> 
                            <div class="row">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="width: 40em; right: 18em;">
                                    <div class="carousel-inner" style="border-radius: 5px;">
                                    @if($post->type_media == 'sidecar')
                                    @foreach(unserialize($post->source_url) as $key => $path)
                                    @if(is_int(strpos(pathinfo($path, PATHINFO_EXTENSION) , 'png')))
                                      <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                        <img class="d-block w-100" src="/uploads/{{ $path  }}">
                                      </div>
                                      @endif
                                      @if (is_int(strpos(pathinfo($path, PATHINFO_EXTENSION) , 'mp4')))
                                      <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                                        <video controls>
                                            <source src="/uploads/{{ $path  }}" type="video/mp4">
                                        </video>
                                      </div>
                                      @endif
                                      @endforeach
                                      @endif

                                      @if($post->type_media != 'sidecar')
                                      @if(is_int(strpos(pathinfo($post->source_url, PATHINFO_EXTENSION) , 'png')))
                                        <div class="carousel-item active">
                                          <img class="d-block w-100" src="/uploads/{{ $post->source_url  }}">
                                        </div>
                                        @endif
                                        @if (is_int(strpos(pathinfo($post->source_url, PATHINFO_EXTENSION) , 'mp4')))
                                        <div class="carousel-item active">
                                          <video controls>
                                              <source src="/uploads/{{ $post->source_url  }}" type="video/mp4">
                                          </video>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <div class="col-md-12" style=" margin-top: 1em;font-family: Vazir">
                                    <div class="contact-directory-box">
                                        <div class="contact-dire-info text-center">
                                            <div class="contact-name">
                                                <h5>{{ $post->owner }}</h5>
                                                <p>{{ $post->tag }}</p>
                                                <div style="padding: 5px;" class="work text-success"><i class="ion-android-time"></i> در مدت زمان : {{ \App\Utilities\TimerPosts::timer($post->date) }}</div>
                                                <div class="work text-warning"><i class="ion-android-calendar"></i> گرفته شده در  : {{ strtok($post->created_at ,' ') }}</div>
                                            </div>
                                                <div class="contact-skill">
                                                    <span style="display: inline-grid;width: 18em;" class="badge badge-pill">لایک : {{ $post->like }}</span>
                                                    <span style="display: inline-grid;width: 18em;" class="badge badge-pill">ویو : {{ $post->view }}</span>
                                                    <span style="display: inline-grid;width: 18em;" class="badge badge-pill">کامنت : {{ $post->comment }}</span>
                                                </div>
                                            </div>
                                            <h4 style="text-align: center;font-family: 'Vazir';">کپشن</h4>
                                            <div style="direction: rtl; text-align: center; padding: 1em;">
                                                {{$post->captions}}
                                            </div>
                                            <div class="contact-skill text-center">
                                                <a href="{{ route('posts.deleteOne' , $post->id) }}"><button type="button" style="font-family: Vazir" class="btn btn-outline-danger btn-sm">حذف</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection