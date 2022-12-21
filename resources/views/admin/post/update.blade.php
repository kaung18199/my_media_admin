@extends('admin.layouts.app')

@section('content')

<div class=" col-4 ">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin#updatePost',$postData->post_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for=""> Title</label>
                    <input type="text" name="postTitle" id="" class="form-control @error('postTitle')
                        is-invalid
                    @enderror" placeholder="Ender Post Title" value="{{ old('postTitle',$postData->title) }}">
                    @error('postTitle')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label for="" class="mt-3">Description</label>
                    <textarea class="form-control @error('description')
                        is-invalid
                    @enderror" cols="30" rows="5" name="description" placeholder="Ender Description" >{{ old('description',$postData->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label for="" class="mt-3"> Image</label>
                    <input type="file" name="postImage" id="" class="form-control " placeholder="Ender category Name">
                    @if ($postData->image == NULL)
                    <img src="{{ asset('default_image/default-image.jpg') }}" alt="" class="col-12 mt-2 rounded shadow p-2">
                    @else
                    <img src="{{ asset('/postImage/'.$postData->image) }}" alt="" class="col-12 mt-2 rounded shadow p-2">
                    @endif

                    <label for="" class="mt-3"> Category Name</label>
                    <select name="postCategory" class="form-control @error('postCategory')
                        is-invalid
                    @enderror">
                        <option value="">Choose Category</option>
                        @foreach ($category as $c)
                        <option value="{{ $c->category_id }}" @if ($postData->category_id == $c->category_id)
                            selected
                        @endif>
                            {{ $c->title }}
                        </option>
                        @endforeach
                    </select>
                    @error('postCategory')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <button class="btn btn-dark text-white mt-3" type="submit">Update</button>
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
        <h3 class="card-title">Post List Page</h3>

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
              <th>Post ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($post as $p)
            <tr>
                <td>{{ $p->post_id}}</td>
                <td>{{ $p->title }}</td>
                <td>
                    @if ($p->image == null)
                    <img src="{{ asset('default_image/default-image.jpg') }}" width="100px" class=" rounded shadow-sm">
                    @else
                    <img src="{{ asset('/postImage/'.$p->image) }}" width="100px" class=" rounded shadow-sm">
                    @endif
                </td>
                <td>
                  <a href="{{ route('admin#editPostPage',$p->post_id) }}">
                    <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                  </a>
                  <a href="{{ route('admin#deletePost',$p->post_id) }}">
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

