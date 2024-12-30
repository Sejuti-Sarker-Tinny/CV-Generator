@extends('layouts.admin')
@section('admin_content')
<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="col-lg-12 d-flex justify-content-between align-items-center">
                    <div>
                        <h3>Manage Bio Data</h3>
                    </div>
                    <div>
                        @php
                            use App\Models\PersonalInfo;
                        @endphp
                        @if(Auth::user() && !PersonalInfo::where('user_id', Auth::user()->id)->exists())
                            <a class="btn btn-success" href="{{ route('bio.create') }}">Create New</a>
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
                                        <td>{{ $user['personal_info']['first_name'] }}</td>
                                        <td>{{ $user['personal_info']['last_name'] }}</td>
                                        <td>{{ $user['personal_info']['email'] }}</td>
                                        <td align="center">
                                            <div class="d-flex flex-row justify-content-around">
                                                <a class="btn btn-primary btn-sm mr-2"
                                                    href="{{ route('bio.view', $user['personal_info']['user_id']) }}"
                                                    title="View Bio Data 1">Bio Data 1
                                                </a>
                                                <a class="btn btn-warning btn-sm mr-2"
                                                    href="{{ route('bio.view_two', $user['personal_info']['user_id']) }}"
                                                    title="View Bio Data 2">
                                                    Bio Data 2
                                                </a>
                                                <a class="btn btn-primary btn-sm mr-2"
                                                    href="{{ route('bio.view_three', $user['personal_info']['user_id']) }}"
                                                    title="View Bio Data 3">
                                                    Bio Data 3
                                                </a>
                                                <a class="btn btn-warning btn-sm mr-2"
                                                    href="{{ route('bio.view_four', $user['personal_info']['user_id']) }}"
                                                    title="View Bio Data 4">
                                                    Bio Data 4
                                                </a>
                                                <a class="edit_btn mr-2"
                                                    href="{{ route('bio.edit', $user['personal_info']['user_id']) }}"
                                                    title="Edit Profile">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('bio.destroy', $user['personal_info']['user_id']) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE') <!-- Add this line to specify the DELETE method -->
                                                    {{-- <a href="javascript:void(0)" class="del_btn" title="Delete Profile">
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

    <script>
        function confirm_form_delete(form) {
            if (confirm("Are you sure you want to delete this profile?")) {
                form.submit();
            }
        }
    </script>    
@endsection
