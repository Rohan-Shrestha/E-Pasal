@extends('admin.layout.layout')
@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sections</h4>
                <!-- <p class="card-description">
                            Add class <code>.table-bordered</code>
                        </p> -->
                <a style="max-width: 150px; float: right; display: inline-block;" href="{{ url('admin/add-edit-section') }}" class="btn btn-block btn-primary">Add Section</a>
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <li>{{ Session::get('success_message')}}</li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="table-responsive pt-3">
                    <table id="sections" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                            <tr>
                                <td>
                                    {{ $section['id'] }}
                                </td>
                                <td>
                                    {{ $section['name'] }}
                                </td>
                                <td>
                                    @if($section['status']==1)
                                    <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}" href="javascript:void(0)"><i style="font-size: 25px;" class="mdi mdi-bookmark-check" status="Active"></i></a>
                                    @else
                                    <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}" href="javascript:void(0)"><i style="font-size: 25px;" class="mdi mdi-bookmark-remove" status="Inactive"></i></a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/add-edit-section/'.$section['id']) }}"><i style="font-size: 25px;" class="mdi mdi-pencil-box"></i></a>
                                    <a href="javascript:void(0)" class="confirmDelete" module="section" module_id="{{ $section['id'] }}"><i style="font-size: 25px;" class="mdi mdi-file-excel-box"></i></a>
                                    <!-- <a title="Section" class="confirmDelete" href="{{ url('admin/delete-section/'.$section['id']) }}"><i style="font-size: 25px;" class="mdi mdi-file-excel-box"></i></a> -->
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
<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<!-- <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. <strong>Rohan Shrestha.</strong> All rights reserved.</span>
        </div>
    </footer> -->
<!-- partial -->
@endsection