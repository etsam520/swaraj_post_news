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


                                <a href="{{route('admin.visual-stories.add')}}" type="button" class="btn btn-sm btn-primary" >
                                    <i class="fa fa-plus me-1"></i>{{__('messages.visula-story')}}
                                </a>

                                <a href="{{route('admin.visual-stories.draft')}}" type="button" class="btn btn-sm btn-primary" >
                                    <i class="fa fa-file-text me-1"></i>Draft Story
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
                                        @foreach ($visualStories as $vs)
                                        <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$vs->title}}</td>
                                        <td>
                                            
                                            <a href="{{ route('admin.visual-stories.show', ['id' => $vs->id??'null']) }}">
                                                View Story
                                            </a>
                                            
                                        </td>
                                        <td>{{Str::ucfirst($vs->status)}}</td>
                                        <td>
                                            {{-- <a class="btn btn-primary fs-14 text-white edit-icn" title="Edit" href="{{route('admin.visual-stories.edit',['id'=> $vs->id])}}">
                                                <i class="fe fe-edit"></i>
                                            </a> --}}
                                            <a class="btn btn-danger fs-14 text-white " title="Edit" onclick="delete_alert(this, 'Want To Remove This Visual Story')" href="{{ route('admin.visual-stories.destroy', $vs->id) }}">
                                                <i class="fe fe-trash"></i>
                                            </a>
                                            @if ($vs->status == "draft")
                                            <a href="{{route('admin.visual-stories.change.status', ['id' => $vs->id,'status'=> 'publish'])}}" onclick="confirm_alert(this, 'Confirm Your Approval')" class="btn btn-info btn-sm">Approve</a>
                                            <a href="{{route('admin.visual-stories.change.status', ['id' => $vs->id, 'status'=> 'reject'])}}" onclick="confirm_alert(this, 'Confirm Your Rejection')" class="btn btn-warning btn-sm">Reject</a>
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

