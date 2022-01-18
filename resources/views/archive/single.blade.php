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
                                {{-- <div class="col-md-10" style="right: 12em;">
                                    @if ($post->type_media != 'sidecar')
                                        <div class="product-slider slider-arrow">
                                            <div class="product-slide">
                                            @if (is_int(strpos(pathinfo($post->source_url, PATHINFO_EXTENSION) , 'png')))
                                                <img src="/uploads/{{ $post->source_url  }}" alt="">	
                                            @endif
                                            @if (is_int(strpos(pathinfo($post->source_url, PATHINFO_EXTENSION) , 'mp4')))
                                                <video controls>
                                                      <source src="/uploads/{{ $post->source_url  }}" type="video/mp4">
                                                </video>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="product-slider-nav">
                                            <div class="product-slide">
                                            @if (is_int(strpos(pathinfo($post->source_url, PATHINFO_EXTENSION) , 'png')))
                                                <img src="/uploads/{{ $post->source_url  }}" alt="">	
                                            @endif
                                            @if (is_int(strpos(pathinfo($post->source_url, PATHINFO_EXTENSION) , 'mp4')))
                                                <img src="/uploads/{{ $post->source_url  }}">
                                            @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if ($post->type_media == 'sidecar')
                                        <div class="product-slider slider-arrow">
                                        @foreach (unserialize($post->source_url) as $path)
                                            @if (is_int(strpos(pathinfo($path, PATHINFO_EXTENSION) , 'png')))
                                            <div class="product-slide">
                                                <img src="/uploads/{{ $path  }}" alt="">
                                            </div>	
                                            @endif
                                            @if (is_int(strpos(pathinfo($path, PATHINFO_EXTENSION) , 'mp4')))
                                            <div class="product-slide">
                                                <video controls>
                                                      <source src="/uploads/{{ $path  }}" type="video/mp4">
                                                </video>		
                                            </div>								
                                            @endif
                                        @endforeach
                                        </div>
                                        <div class="product-slider-nav">
                                            
                                        @foreach (unserialize($post->source_url) as $path)
                                            @if (is_int(strpos(pathinfo($path, PATHINFO_EXTENSION) , 'png')))
                                            <div class="product-slide">
                                                <img src="/uploads/{{ $path  }}" alt="">
                                            </div>	
                                            @endif
                                            @if (is_int(strpos(pathinfo($path, PATHINFO_EXTENSION) , 'mp4')))
                                            <div class="product-slide">
                                                <video controls>
                                                    <source src="/uploads/{{ $path  }}" type="video/mp4">
                                                </video>		
                                            </div>								
                                            @endif
                                        @endforeach
                                        </div>
                                    @endif
                                </div> --}}

                                <div class="container" style="direction: ltr">
                                    <div class="slider">
                                      @if($post->type_media == 'sidecar')
                                      @foreach(unserialize($post->source_url) as $key => $path)
                                      @if(is_int(strpos(pathinfo($path, PATHINFO_EXTENSION) , 'png')))
                                      <img class="{{$key == 0 ? 'active' : ''}}" src="/uploads/{{ $path  }}">
                                      @endif
                                      @if (is_int(strpos(pathinfo($path, PATHINFO_EXTENSION) , 'mp4')))
                                        <video controls>
                                            <source class="{{$key == 0 ? 'active' : ''}}" src="/uploads/{{ $path  }}" type="video/mp4">
                                        </video>		
                                      @endif
                                      @endforeach
                                      @endif

                                      @if($post->type_media != 'sidecar')
                                      @if(is_int(strpos(pathinfo($post->source_url, PATHINFO_EXTENSION) , 'png')))
                                      <img class="active" src="/uploads/{{ $post->source_url  }}">
                                      @endif
                                      @if (is_int(strpos(pathinfo($post->source_url, PATHINFO_EXTENSION) , 'mp4')))
                                        <video controls>
                                            <source class="active" src="/uploads/{{ $post->source_url  }}" type="video/mp4">
                                        </video>		
                                      @endif
                                      @endif
                                    </div>
                                    <nav class="slider-nav">
                                      <ul>
                                        <li class="arrow">
                                          <button class="previous">
                                            <span>
                                              <i class="ion-arrow-left-c"></i>
                                            </span>
                                          </button>
                                        </li>
                                        <li class="arrow">
                                          <button class="next">
                                            <span>
                                              <i class="ion-arrow-right-c"></i>
                                            </span>
                                          </button>
                                        </li>
                                      </ul>
                                    </nav>
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