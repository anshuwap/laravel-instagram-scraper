@extends('layouts.admin.master')

@section('admin-content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="row">
            @include('errors.msg')
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">لیست روبات های پلتفرم</h3>
  
                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
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
                        <th>وضعیت</th>
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
                            {{-- <span class="tag tag-success">Approved</span> --}}
                        </td>
                        <td>
                            <a href="{{ route('robots.edit' , $robot->id) }}" class="btn btn-default btn-icons"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('robots.delete' , $robot->id) }}" method="post" style="display: inline"> 
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-default btn-icons"><i class="fa fa-trash"></i></button>
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
        </div>
    </div>

</section>
@endsection 
