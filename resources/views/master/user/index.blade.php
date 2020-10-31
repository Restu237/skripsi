@extends('layouts.my')

@section('content')
@include('layouts.sidenav')
<div class="main-content" id="panel">
    @include('layouts.navigasi')

    <div class="main-master pt-7">
        <div class="container-fluid mt--6">
            <div class="row justify-content-center">
                <div class=" col ">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0 text-center"><b>MASTER USER</b></h3>
                        </div>
                        
                            @if (Session::has('sukses'))
                            <div class="pesan m-4">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-icon"><i class="fas fa-check""></i></span>
                                <span class="alert-text">{!! Session::get('sukses') !!}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                            @endif
                        
                     
                        <div class="card-body">
                            <div class="baru pb-2">
                                <button id="buat-baru" type="button" class="btn btn-sm" data-toggle="modal" data-target="#create-user-baru"><i class="fas fa-plus"></i> </button>
                                <p class="text-baru">Buat User Baru</p>
                            </div>
                            <table id="user_master" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        @if ($item->kd_kstmr == null) 
                                        <td>Belum Di Registrasikan Sebagai Agent</td>
                                        @else
                                        <td>{{$item->kd_kstmr}}</td>
                                        @endif
                                        <td>{{$item->email}}</td>
                                        @if ($item->type == 0)
                                         <td> <a href="#" class="badge badge-pill badge-info">User Agent</a></td>
                                        @else
                                         <td><a href="#" class="badge badge-pill badge-default">Admin/Staff</a></td>
                                        @endif
                                        <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#edit{{$item->id}}">Edit</button><button type="button" data-toggle="modal" data-target="#modalKonfirmasi{{$item->id}}" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                              <h5 class="modal-title text-white" id="editUser">Edit User</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('register') }}">
                                                    @csrf
                                    
                                                    <div class="form-group row">
                                                        <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>
                                    
                                                        <div class="col-md-8">
                                                        <input id="name" type="text" value="{{$item->name}}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                    
                                                    <div class="form-group row">
                                                        <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                                    
                                                        <div class="col-md-8">
                                                            <input id="email" type="email" value="{{$item->email}}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="pilihAgent" class="col-md-4 col-form-label text-md-left">Pilih Customers</label>
                                                        <div class="col-md-8">
                                                            <select class="form-control" id="pilihAgent">
                                                                <option>1 Dummy</option>
                                                                <option>2 Dummy</option>
                                                                <option>3 Dummy</option>
                                                                <option>4 Dummy</option>
                                                                <option>5 Dummy</option>
                                                              </select>
                                                        </div>
                                                    </div>
                                    
                                                    <div class="form-group row">
                                                        <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>
                                    
                                                        <div class="col-md-8">
                                                            <input id="password" type="password" placeholder="Password Baru.."  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                    
                                                    <div class="form-group row">
                                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}</label>
                                    
                                                        <div class="col-md-8">
                                                            <input id="password-confirm" type="password"  placeholder="Ulangi Password Baru.." class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                        </div>
                                                    </div>
                                    
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-8 offset-md-4">
                                                            <button type="submit" class="btn btn-warning">
                                                                {{ __('Update') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-4">
                                        <div class="modal fade" id="modalKonfirmasi{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                      <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                                          <div class="modal-content bg-gradient-danger">
                                              
                                              <div class="modal-header">
                                                  <h6 class="modal-title" id="modal-title-notification">Konfirmasi Hapus File !</h6>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                  </button>
                                              </div>
                                              
                                              <div class="modal-body">
                                                  
                                                  <div class="py-3 text-center">
                                                      <i class="fas fa-trash fa-3x"></i>
                                                      <h4 class="heading mt-4">Anda Yakin Menghapus User Berikut :</h4>
                                                      <p>{{$item->name}}</p>
                                                  </div>
                                                  
                                              </div>
                                              
                                              <div class="modal-footer">
                                              <a href="/user/delete/{{$item->id}}" class="btn btn-md text-danger mr-auto bg-white">Ya, Saya Yakin!</a>
                                                  <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                                              </div>
                                              
                                          </div>
                                      </div>
                                    
                                   
                                      @endforeach
                                </tbody>
                            </table>                          
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="create-user-baru" tabindex="-1" role="dialog" aria-labelledby="buatuserBaru" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="buatuserBaru">Buat User Baru</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="/home/master/user">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>

                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

                    <div class="col-md-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
          
        </div>
      </div>
    </div>
  </div>
@endsection
