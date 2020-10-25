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
                        <div class="card-body">
                            <table id="user_master" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Customer</th>
                                        <th>Telephon</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>PT. Cipta Ankea Air</td>
                                        <td>00002929292992</td>
                                        <td>User</td>
                                        <td>Edit, Update, Delete</td>
                                    </tr>
                                </tbody>
                            </table>                          
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection
