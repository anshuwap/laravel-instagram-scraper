@extends('layouts.admin.master')

@section('admin-content')
<section class="content">
    <div class="container-fluid">
      @include('errors.msg')
        <div class="row">
          <a href="{{ route('proxies.add') }}" class="btn btn-block btn-outline-success">افزودن</a>
          <a href="{{ route('proxies.checkStatus') }}" style="width: 14em;" class="btn btn-block btn-outline-primary">بروزرسانی وضعیت پروکسی ها</a>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">لیست پروکسی های پلتفرم</h3>
  
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
                <form action="{{ route('proxies.deleteAll') }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" style="font-family: Vazir" class="btn btn-danger">حذف همه</button>
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th></th>
                        <th>شناسه</th>
                        <th>پروکسی</th>
                        <th>وضعیت پروکسی</th>
                        <th>تاریخ</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($proxies as $proxy)
                      <tr>
                        <td><input type='checkbox' name='delete-proxies[]' value="{{ $proxy->id }}"></td>
                        <td>{{ $proxy->id }}</td>
                        <td>{{ $proxy->proxy }}</td>
                        <td>
                          @if($proxy->proxy_status == 'online')
                            <span class="badge bg-success">Online</span>
                          @endif
                          @if($proxy->proxy_status == 'offline')
                            <span class="badge bg-danger">Offline</span>
                          @endif
                        </td>
                        <td>{{ $proxy->created_at }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div>
                      {{$proxies->links('pagination::bootstrap-4')}}
                  </div>
                </div>
              </form>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection 

