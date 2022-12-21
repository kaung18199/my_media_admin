@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                {{-- alert start --}}
                @if (Session::has('fail'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session::get('fail') }}
                    <button type="button" class="btn-close btn-sm btn-warning mx-5" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                {{-- alert end --}}
              <form class="form-horizontal" method="POST" action="{{ route('admin#change') }}">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-4 col-form-label @error('name') is-invalid @enderror">Old Password</label>
                  <div class="col-8">
                    <input type="password" class="form-control" id="inputName" name="oldPassword" placeholder="Enter old password" value="">
                    @error('oldPassword')
                          <div class="text-danger">
                            {{ $message }}
                          </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-4 col-form-label">New Password</label>
                  <div class="col-8">
                    <input type="password" class="form-control" id="inputEmail" name="newPassword" placeholder="Enter New Password" value="">
                    @error('newPassword')
                          <div class="text-danger">
                            {{ $message }}
                          </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-4 col-form-label">Comfirm Password</label>
                    <div class="col-8">
                      <input type="password" class="form-control" id="inputEmail" name="comfirmPassword" placeholder="Enter comfirm Password" value="">
                      @error('comfirmPassword')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                      @enderror
                    </div>
                </div>

                <div class="form-group row">
                  <div class="offset-sm-4 col-8">
                    <button type="submit" class="btn bg-dark text-white">Update Password</button>
                  </div>
                </div>
              </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
