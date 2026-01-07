@extends('admin.layouts.admin_master')

@section('containt')
<!--app-content open-->
<div class="app-content main-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <div>
                    <h1 class="page-title">Users Table</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Tables</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-bottom d-flex justify-content-between">
                            <h3 class="card-title">Basic Datatable</h3>
                            <a href="{{route('admin.user.add')}}" type="button" class="btn btn-sm btn-primary" >
                                <i class="fa fa-plus">Add User</i>
                            </a>
                            <a href="{{route('admin.user.roles.index')}}" type="button" class="btn btn-sm btn-primary" >
                                <i class="fa fa-bars">Roles</i>
                            </a>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">Id</th>
                                            <th class="wd-15p border-bottom-0">User Name</th>
                                            <th class="wd-20p border-bottom-0">Role</th>
                                            <th class="wd-20p border-bottom-0">Action</th>
                                            {{-- <th class="wd-15p border-bottom-0">Start date</th>
                                            <th class="wd-10p border-bottom-0">Salary</th>
                                            <th class="wd-25p border-bottom-0">E-mail</th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users  as $user)
                                        <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>
                                            @if ($user->roles->isEmpty())
                                                <span class="text-muted">No roles assigned</span>
                                            @else
                                                @foreach ($user->roles as $role)
                                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-primary fs-14 text-white edit-icn" title="Edit" href="{{route('admin.user.edit', ['user' =>$user->id])}}">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
    </div>
</div>
<!-- CONTAINER CLOSED -->
@endsection
