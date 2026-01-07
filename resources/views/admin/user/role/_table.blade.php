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
                    <h1 class="page-title">Roles Tables</h1>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Roles Tables</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                        <div class="card-header border-bottom d-flex justify-content-between">
                            <h3 class="card-title">Basic Datatable</h3>
                            <a href="{{route('admin.user.roles.add')}}" type="button" class="btn btn-sm btn-primary" >
                                <i class="fa fa-plus">Add Roles</i>
                            </a>
                            <a href="{{route('admin.user.permissions.index')}}" type="button" class="btn btn-sm btn-primary">
                                <i class="fa fa-bars">Permission</i>
                            </a>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">Id</th>
                                            <th class="wd-15p border-bottom-0">Name</th>
                                            <th class="wd-20p border-bottom-0">Permissions</th>
                                            <th class="wd-20p border-bottom-0">Action</th>
                                            {{-- <th class="wd-15p border-bottom-0">Start date</th>
                                            <th class="wd-10p border-bottom-0">Salary</th>
                                            <th class="wd-25p border-bottom-0">E-mail</th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($roles as $role)
                                        <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td class="d-flex flex-wrap">
                                            @if ($role->permissions->isEmpty())
                                                <span class="text-muted">No Permissions assigned</span>
                                            @else
                                                @foreach ($role->permissions as $permission)
                                                    <span class="badge bg-primary me-1 mb-1">{{ $permission->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary fs-14 text-white edit-icn" title="Edit" href="{{route('admin.user.roles.edit', ['id' => $role->id])}}">
                                                <i class="fe fe-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.user.roles.destroy',['id' => $role->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Role item?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="fe fe-trash"></i></button>
                                            </form>
                                        </td>
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
