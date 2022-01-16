@extends('layouts.admin.master')

@section('admin-content')
<section class="content">
    <div class="container-fluid" style="font-family: 'Vazir';">
        <div class="row" style="text-align: right;">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $postCount }}</h3>
  
                  <p>تعداد پست ها</p>
                </div>
                <div class="icon">
                    <i class="fab fa-instagram"></i>
                </div>
                <a href="{{ route('posts.showAll') }}" class="small-box-footer">بیشتر <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $robotsCount }}</h3>
  
                  <p>تعداد ربات ها</p>
                </div>
                <div class="icon">
                  <i class="nav-icon fas fa-robot"></i>
                </div>
                <a href="{{ route('robots.list') }}" class="small-box-footer">بیشتر <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ $usersCount }}</h3>
  
                  <p>کاربران</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="" class="small-box-footer">بیشتر <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $proxiesCount }}</h3>
  
                  <p>پروکسی ها</p>
                </div>
                <div class="icon">
                  <i class="fas fa-clipboard-check"></i>
                </div>
                <a href="{{ route('proxies.showAll') }}" class="small-box-footer">بیشتر <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
        
    </div>
</section>


@endsection