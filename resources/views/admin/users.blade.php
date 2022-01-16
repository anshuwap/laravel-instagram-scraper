@extends('layouts.admin.master')

@section('admin-content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <a href="{{ route('users.add') }}" class="btn btn-block btn-outline-success">افزودن کاربر</a>
      </div>
      @include('errors.msg')
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">لیست روبات های پلتفرم</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default" style="width:3em; margin: 0em">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>شناسه</th>
                        <th>نام</th>
                        <th>شماره همراه</th>
                        <th>ایمیل</th>
                        <th>نقش کاربری</th>
                        <th>عملیات</th>
                        <th>تاریخ</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->permission }}</td>
                        <td>
                            <a href="{{ route('users.edit' , $user->id) }}" style="width:3em" class="btn btn-default btn-outline-warning btn-icons"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('users.delete' , $user->id) }}" method="post" style="display: inline"> 
                              @csrf
                              @method('delete')
                              <button type="submit" style="width:3em" class="btn btn-default btn-outline-danger btn-icons"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <td>{{ $user->created_at }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div>
                      {{$users->links('pagination::bootstrap-4')}}
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection 

