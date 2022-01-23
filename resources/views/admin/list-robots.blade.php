@extends('layouts.admin.master')

@section('admin-content')
<section class="content">
    <div class="container-fluid">
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
                        <th>نام کاربری پیج</th>
                        <th>رمز</th>
                        <th>پروکسی</th>
                        <th>وضعیت پروکسی</th>
                        <th>عملیات</th>
                        <th>تاریخ</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($robots as $robot)
                      <tr>
                        <td>{{ $robot->id }}</td>
                        <td>{{ $robot->username }}</td>
                        <td>{{ $robot->password }}</td>
                        <td>{{ $robot->proxy }}</td>
                        <td>
                          @if($robot->proxy_status == 'online')
                            <span class="badge bg-success">Online</span>
                          @endif
                          @if($robot->proxy_status == 'offline')
                            <span class="badge bg-danger">Offline</span>
                          @endif
                        </td>
                        <td>
                            <form action="{{ route('robots.changeProxy' , $robot->id) }}" method="post" style="display: inline"> 
                              @csrf
                              @method('put')
                              <button type="submit" style="width:3em" class="btn btn-default btn-outline-success btn-icons"><i class="fas fa-sync"></i></i></button>
                            </form>

                            <a href="{{ route('robots.edit' , $robot->id) }}" style="width:3em" class="btn btn-default btn-outline-warning btn-icons"><i class="fa fa-edit"></i></a>
                            
                            <form action="{{ route('robots.delete' , $robot->id) }}" method="post" style="display: inline"> 
                              @csrf
                              @method('delete')
                              <button type="submit" style="width:3em" class="btn btn-default btn-outline-danger btn-icons"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <td>{{ $robot->created_at }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div>
                      {{$robots->links('pagination::bootstrap-4')}}
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

