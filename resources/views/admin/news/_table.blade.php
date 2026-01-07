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
                    <h1 class="page-title">Data Tables</h1>
                    <a href="{{ url()->current() }}?lang=hi">Hindi</a>
                    <a href="{{ url()->current() }}?lang=en">English</a>
                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
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
                            <div class="">
                                <a href="{{route('admin.news.add')}}" type="button" class="btn btn-sm btn-primary" >
                                    <i class="fa fa-plus me-1"></i>Add News
                                </a>
                                <a href="{{route('admin.news.draft')}}" type="button" class="btn btn-sm btn-primary" >
                                    <i class="fa fa-file-text me-1"></i>Draft News
                                </a>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">##</th>
                                            <th class="wd-15p border-bottom-0">Title</th>
                                            <th class="wd-20p border-bottom-0">View</th>
                                            <th class="wd-20p border-bottom-0">Status</th>
                                            <th class="wd-20p border-bottom-0">Action</th>
                                            {{-- <th class="wd-15p border-bottom-0">Start date</th>
                                            <th class="wd-10p border-bottom-0">Salary</th>
                                            <th class="wd-25p border-bottom-0">E-mail</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($news as $n)
                                        <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$n->headline}}</td>
                                        <td> <a href="{{ route('admin.news.show', ['locale' => app()->getLocale(), 'slug' => $n->slug??'null']) }}">
                                            View News
                                        </a></td>
                                        <td>{{Str::ucfirst($n->status)}}</td>
                                        <td>

                                            <a class="btn btn-primary fs-14 text-white edit-icn" title="Edit" href="{{route('admin.news.edit', ['news'=> $n->id])}}">
                                                <i class="fe fe-edit"></i>
                                            </a>

                                            <a class="btn btn-danger fs-14 text-white " title="Delete" onclick="delete_alert(this, 'Want To Remove This News')" href="{{ route('admin.news.destroy', $n->id) }}">
                                                <i class="fe fe-trash"></i>
                                            </a>

                                            @if ($n->status == "pending")

                                            <a href="{{route('admin.news.change.status', ['id' => $n->id,'status'=> 'publish'])}}" onclick="confirm_alert(this, 'Confirm Your Approval')" class="btn btn-info btn-sm" title="Approve">Approve</a>
                                            <a href="{{route('admin.news.change.status', ['id' => $n->id, 'status'=> 'reject'])}}" onclick="confirm_alert(this, 'Confirm Your Rejection')" class="btn btn-warning btn-sm" title="Reject">Reject</a>

                                            @endif
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

