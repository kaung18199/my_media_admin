@extends('admin.layouts.app')

@section('content')

<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post List Page</h3>

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
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($post as $p)
            <tr>
                <td>{{ $p->post_id }}</td>
                <td>{{ $p->title }}</td>
                <td>
                    @if($p->image == null)
                    <img src="{{ asset('default_image/default-image.jpg') }}" alt="" class="rounded shadow " width="100px">
                    @else
                    <img src="{{ asset('postImage/'.$p->image) }}" alt="" class=" rounded shadow" width="100px">
                    @endif
                </td>
                <td>{{ $p->post_count }}</td>
                <td>
                  <a href="{{ route('admin#detailsPage',$p->post_id) }}">
                    <button class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-eye"></i></button>
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
    {{-- {{ $post->links() }} --}}

</div>

@endsection
