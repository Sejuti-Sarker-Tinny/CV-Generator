@extends('layouts.admin')
@section('admin_content')
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="col-lg-12 d-flex justify-content-between align-items-center">
                    <div>
                        <h3>Manage User Profiles</h3>
                    </div>
                    <div>

                        @php
                            use App\Models\PersonalInformation;
                        @endphp
                        @if(Auth::user() && !PersonalInformation::where('user_id', Auth::user()->id)->exists())
                        <a class="btn btn-success" href="{{ route('user.profile.create') }}">Create New</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Profile Photo</th>
                                <th>Title</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($users_data as $user)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>
                                            <img class="profile box-image-preview img-fluid img-circle elevation-2" src="{{ isset($user['personal_info']['image_path']) && !empty($user['personal_info']['image_path']) ? asset('assets/images/'. $user['personal_info']['image_path'])  : asset('assets/images/user-thumb.jpg') }}"
                                            alt="" style="height:40px; width:40px;" />
                                        </td>
                                        <td>{{ $user['personal_info']['profile_title'] }}</td>
                                        <td>{{ $user['personal_info']['first_name'] }}</td>
                                        <td>{{ $user['personal_info']['last_name'] }}</td>
                                        <td>{{ $user['contact_info']['email'] }}</td>
                                        <td align="center">
                                            <div class="d-flex flex-row justify-content-around">
                                                <a class="btn btn-primary btn-sm mr-2"
                                                    href="{{ route('user.profile.view', $user['personal_info']['user_id']) }}"
                                                    title="View CV 1">CV 1
                                                </a>
                                                <a class="btn btn-warning btn-sm mr-2"
                                                    href="{{ route('user.profile.view_two', $user['personal_info']['user_id']) }}"
                                                    title="View CV 2">
                                                    CV 2
                                                </a>
                                                <a class="btn btn-primary btn-sm mr-2"
                                                    href="{{ route('user.profile.view_three', $user['personal_info']['user_id']) }}"
                                                    title="View CV 3">
                                                    CV 3
                                                </a>
                                                <a class="btn btn-warning btn-sm mr-2"
                                                    href="{{ route('user.profile.view_four', $user['personal_info']['user_id']) }}"
                                                    title="View CV 4">
                                                    CV 4
                                                </a>
                                                <a class="edit_btn mr-2"
                                                    href="{{ route('edit', $user['personal_info']['user_id']) }}"
                                                    title="Edit Profile">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('destroy', $user['personal_info']['user_id']) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <a href="javascript::void(0)" onclick="confirm_form_delete(this)"
                                                        class="del_btn" title="Delete Profile">
                                                        <i class="fas fa-user-minus text-danger"></i>
                                                    </a> --}}
                                                    <button type="submit"><i class="fas fa-user-minus text-danger"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
