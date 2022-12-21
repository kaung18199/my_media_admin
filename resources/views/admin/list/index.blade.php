@extends('admin.layouts.app')

@section('content')

<div class="col-12">
    <div class="col-5">
        @if(session('deleteSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('deleteSuccess') }}
                <button type="button" class="btn-close btn-sm btn-success mx-5" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
        @endif
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List Page</h3>

        <div class="card-tools">
          <form action="{{ route('admin#list') }}" method="GET">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="key" class="form-control float-right" placeholder="Search" value="{{ request('key') }}">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($userList as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u['email'] }}</td>
                <td>{{ $u->phone }}</td>
                <td>{{ $u->address }}</td>
                <td>{{ $u->gender }}</td>
                <td>
                  @if ($u->id == Auth::user()->id)

                  @else
                  {{-- <a  href="{{ route('admin#accountDelete',$u->id) }}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                  </a> --}}
                  <a onclick="return confirm('Are you sure?')" href="{{ route('admin#accountDelete',$u->id) }}" class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@endsection
