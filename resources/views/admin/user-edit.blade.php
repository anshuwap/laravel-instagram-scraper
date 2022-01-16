@extends('layouts.admin.master')

@section('admin-content')
<section class="content">
    <div class="container-fluid">
        @include('errors.msg')
      <div class="row">
        <!-- left column -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">بروزرسانی کاربر {{ $user->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('users.update' , $user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">نام </label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                                </div>
                                <div class="col-6">
                                    <label for="number">شماره همراه</label>
                                    <input type="text" name="number" class="form-control" id="number" value="{{$user->number}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="email">ایمیل </label>
                                    <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
                                </div>
                                <div class="col-6">
                                    <label for="select-permission">نقش کاربر</label>
                                    <select class="form-control" id="select-permission" name="permission">
                                        @foreach($permissions as $permission)
                                        <option value="{{ $permission }}" {{ $permission == $user->permission ? 'selected' : '' }}>{{ $permission }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">بروزرسانی</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection 

