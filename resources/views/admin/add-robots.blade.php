@extends('layouts.admin.master')

@section('admin-content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        @include('errors.msg')
        <!-- left column -->
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">اضافه کردن روبات جدید</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('robots.storeNew') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">نام کاربری پیج</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">رمز عبور پیج</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">پروکسی</label>
                            <input type="text" name="proxy" class="form-control" id="exampleInputPassword1" placeholder="Proxy">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

</section>
@endsection 

