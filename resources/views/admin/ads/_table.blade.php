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
                    <h1 class="page-title">Ads List</h1>

                </div>
                <div class="ms-auto pageheader-btn">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ads List</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-bottom d-flex justify-content-between">
                            <h3 class="card-title">Ads List</h3>
                            <div class="">


                                <a href="{{route('admin.ads.create')}}" type="button" class="btn btn-sm btn-primary" >
                                    <i class="fa fa-plus me-1"></i>Create
                                </a>

                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">##</th>
                                            <th class="wd-20p border-bottom-0">Title</th>
                                            <th class="wd-20p border-bottom-0">Link</th>
                                            <th class="wd-20p border-bottom-0">Description</th>
                                            <th class="wd-20p border-bottom-0">Cover Image</th>
                                            <th class="wd-20p border-bottom-0">Status</th>
                                            <th class="wd-20p border-bottom-0">Created At</th>
                                            <th class="wd-20p border-bottom-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ads as $ad)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>

                                            <td>{{ $ad->title }}</td>
                                            <td>
                                                @if ($ad->link)
                                                    <a href="{{ $ad->link }}" target="_blank" class="text-primary">{{ Str::limit($ad->link, 30) }}</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($ad->description, 50) }}</td>
                                            <td>
                                                @if ($ad->cover_image)
                                                    <img src="{{Helpers::getCloudImageUrl($ad->cover_image) }}" alt="Ad Image" style="width: 70px; height: 50px; object-fit: cover;">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge {{ $ad->status ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $ad->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>{{ $ad->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                {{-- Example Action Buttons (you'll need routes for these) --}}
                                                <a href="{{ route('admin.ads.edit', $ad->id) }}" class="btn btn-sm btn-primary fs-14 text-white edit-icn"><i class="fe fe-edit"></i></a>
                                                <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger fs-14 text-white" onclick="return confirm('Are you sure you want to delete this ad?');"><i class="fe fe-trash"></i></button>
                                                </form>
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

