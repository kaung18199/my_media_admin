@extends('admin.layouts.app')

@section('content')

<div class=" col-4 ">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin#createCategory') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for=""> Category Name</label>
                    <input type="text" name="categoryName" id="" class="form-control @error('categoryName')
                        is-invalid
                    @enderror" placeholder="Ender category Name">
                    @error('categoryName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label for="" class="mt-3">Description</label>
                    <textarea class="form-control @error('description')
                        is-invalid
                    @enderror" cols="30" rows="5" name="description" placeholder="Ender Description"></textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <button class="btn btn-dark text-white mt-3" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class=" col-8 ">

    <div class="col">
        @if(session('deleteSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('deleteSuccess') }}
                <button type="button" class="btn-close btn-sm btn-warning mx-5" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
        @endif
        <div class="col">
            @if(session('successUpdate'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('successUpdate') }}
                    <button type="button" class="btn-close btn-sm btn-success mx-5" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            @endif
        </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category List Page</h3>

        <div class="card-tools">
          <form action="" method="GET">
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
              <th>Category ID</th>
              <th>Category Name</th>
              <th>description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($category as $c)
            <tr>
                <td>{{ $c->category_id }}</td>
                <td>{{ $c->title }}</td>
                <td>{{ $c->description }}</td>
                <td>
                  <a href="{{ route('admin#editCategoryPage',$c->category_id) }}">
                    <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                  </a>
                  <a href="{{ route('admin#deleteCategory',$c->category_id) }}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                  </a>
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
