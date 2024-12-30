@extends('layouts.admin')
@section('admin_content')
<div class="content-wrapper mt-4">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title">Edit Bio Data</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 p-md-5 p-sm-4 p-3">
                                <form action="{{ route('bio.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{-- Personal Information --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="fw-bold text-secondary">Personal Information</h2>
                                            <div class="form-outline mb-4">
                                                <input type="hidden" id="user_id" name="user_id" class="form-control"
                                                    value="{{ isset($information['personal_info']['user_id']) ? $information['personal_info']['user_id'] : '' }}" />
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-12">
                                                            <div class="col-12">
                                                                <div class="form-outline mb-4">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">First
                                                                        name</label>
                                                                    <input type="text" id="first_name"
                                                                        name="first_name" placeholder="First name"
                                                                        class="form-control"
                                                                        value="{{ isset($information['personal_info']['first_name']) ? $information['personal_info']['first_name'] : '' }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-outline">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">Last
                                                                        name</label>
                                                                    <input type="text" id="last_name"
                                                                        name="last_name" placeholder="Last name"
                                                                        class="form-control"
                                                                        value="{{ isset($information['personal_info']['last_name']) ? $information['personal_info']['last_name'] : '' }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-12">
                                                        <!-- picture border -->
                                                        <!-- <div class="col-8 col-md-8" style="border: 2px solid red; padding: 4px; text-align: center;">
                                                            <p style="color: red;">Click here to upload image</p>
                                                        </div> -->

                                                        <div class="col-8 col-md-8" style=" padding: 4px; text-align: center;">
                                                           {{-- <p style="color: red;">Click here to upload image</p>--}}
                                                            <a class="btn btn-success" href=" ">Click below to upload image</a>
                                                        </div>



                                                    
                                                            <div class="profile_picture text-center">
                                                                <input type="file" name="image_path"
                                                                    accept="image/png, image/jpeg, image/jpg"
                                                                    onchange="display_image(this);"
                                                                    class="d-none upload-box-image">
                                                                <img class="box-image-preview img-fluid img-circle elevation-2"
                                                                    src="{{ isset($information['personal_info']['image_path']) && !empty($information['personal_info']['image_path']) ? asset('assets/images/' . $information['personal_info']['image_path']) : asset('assets/images/user-thumb.jpg') }}"
                                                                    alt="Profile picture"
                                                                    onclick="$(this).closest('.profile_picture').find('input').click();"
                                                                    style="height:150px; width:150px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Father's name</label>
                                                                <input type="text" id="father_name" name="father_name" placeholder="Father's name" class="form-control"
                                                                       value="{{ isset($information['personal_info']['father_name']) ? $information['personal_info']['father_name'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Mother's name</label>
                                                                <input type="text" id="mother_name" name="mother_name" placeholder="Mother's name" class="form-control"
                                                                       value="{{ isset($information['personal_info']['mother_name']) ? $information['personal_info']['mother_name'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Email</label>
                                                                <input type="email" id="email" name="email"
                                                                    placeholder="Email" class="form-control"
                                                                    value="{{ isset($information['personal_info']['email']) ? $information['personal_info']['email'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Phone
                                                                    number</label>
                                                                <input type="number" id="phone_number" name="phone_number"
                                                                    placeholder="Phone Number" class="form-control"
                                                                    value="{{ isset($information['personal_info']['phone_number']) ? $information['personal_info']['phone_number'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">NID Number</label>
                                                                <input type="string" id="nid" name="nid"
                                                                    placeholder="NID Number" class="form-control"
                                                                    value="{{ isset($information['personal_info']['nid']) ? $information['personal_info']['nid'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Religion</label>
                                                                <input type="string" id="religion" name="religion"
                                                                    placeholder="Religion" class="form-control"
                                                                    value="{{ isset($information['personal_info']['religion']) ? $information['personal_info']['religion'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Marital Staus</label>
                                                                <input type="string" id="marital_sttaus" name="marital_sttaus"
                                                                    placeholder="Marital Staus" class="form-control"
                                                                    value="{{ isset($information['personal_info']['marital_sttaus']) ? $information['personal_info']['marital_sttaus'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Gender</label>
                                                                <input type="string" id="gender" name="gender"
                                                                    placeholder="Gender" class="form-control"
                                                                    value="{{ isset($information['personal_info']['gender']) ? $information['personal_info']['gender'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Nationality</label>
                                                                <input type="string" id="nationality" name="nationality"
                                                                    placeholder="Nationality" class="form-control"
                                                                    value="{{ isset($information['personal_info']['nationality']) ? $information['personal_info']['nationality'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Date of Birth</label>
                                                                <input type="date" id="dob" name="dob"
                                                                    placeholder="Date of Birth" class="form-control"
                                                                    value="{{ isset($information['personal_info']['dob']) ? $information['personal_info']['dob'] : '' }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Address</label>
                                                                <input type="text" id="address" name="address" placeholder="Address" class="form-control"
                                                                       value="{{ isset($information['personal_info']['address']) ? $information['personal_info']['address'] : '' }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Education --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="fw-bold text-secondary">Education</h2>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button class="btn btn-primary" id="add_education">Add
                                                        Education</button>
                                                </div>
                                            </div>
                                            <section class="education_section">
                                                @foreach ($information['education_info'] as $edu_info)
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <span onclick="remove_section(this)"
                                                                class="position-absolute"
                                                                style="top: 10px; right: 15px; cursor: pointer;"><i
                                                                    class="fa fa-close"></i></span>
                                                            <div class="form-outline mb-4">
                                                                <label
                                                                    class="form-label fw-bold text-secondary">Degree</label>
                                                                <input type="text" id="degree_title"
                                                                    name="degree_title[]" class="form-control"
                                                                    placeholder="Degree"
                                                                    value="{{ isset($edu_info['degree_title']) ? $edu_info['degree_title'] : '' }}" />
                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label
                                                                    class="form-label fw-bold text-secondary">Institute</label>
                                                                <input type="text" id="institute"
                                                                    name="institute[]" class="form-control"
                                                                    placeholder="Institute"
                                                                    value="{{ isset($edu_info['institute']) ? $edu_info['institute'] : '' }}" />
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-sm-6 col-12">
                                                                    <div class="form-outline">
                                                                        <label
                                                                            class="form-label fw-bold text-secondary">Start
                                                                            Date</label>
                                                                        <input type="date" id="edu_start_date"
                                                                            name="edu_start_date[]"
                                                                            class="form-control"
                                                                            value="{{ isset($edu_info['edu_start_date']) ? $edu_info['edu_start_date'] : '' }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-12">
                                                                    <div class="form-outline">
                                                                        <label
                                                                            class="form-label fw-bold text-secondary">End
                                                                            Date</label>
                                                                        <input type="date" id="edu_end_date"
                                                                            name="edu_end_date[]" class="form-control"
                                                                            value="{{ isset($edu_info['edu_end_date']) ? $edu_info['edu_end_date'] : '' }}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label
                                                                    class="form-label fw-bold text-secondary">Description</label>
                                                                <textarea class="form-control" placeholder="Descripton" id="education_description" name="education_description[]"
                                                                    rows="4">{{ isset($edu_info['education_description']) ? $edu_info['education_description'] : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </section>
                                        </div>
                                    </div>

                                    {{-- Experiencce --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="fw-bold text-secondary">Experience</h2>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button class="btn btn-primary" id="add_experience">Add
                                                        Experience</button>
                                                </div>
                                            </div>
                                            <section class="experience_section">
                                                @foreach ($information['experience_info'] as $exp_info)
                                                    <div class="card mb-4">
                                                        <div class="card-body">
                                                            <span onclick="remove_section(this)"
                                                                class="position-absolute"
                                                                style="top: 10px; right: 15px; cursor: pointer;"><i
                                                                    class="fa fa-close"></i></span>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label fw-bold text-secondary">Job
                                                                    Title</label>
                                                                <input type="text" id="job_title"
                                                                    name="job_title[]" class="form-control"
                                                                    placeholder="Job Title"
                                                                    value="{{ isset($exp_info['job_title']) ? $exp_info['job_title'] : '' }}" />
                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label
                                                                    class="form-label fw-bold text-secondary">Organization</label>
                                                                <input type="text" id="organization"
                                                                    name="organization[]" class="form-control"
                                                                    placeholder="Organization"
                                                                    value="{{ isset($exp_info['organization']) ? $exp_info['organization'] : '' }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </section>
                                        </div>
                                    </div>


                                    <!-- Checkbox -->
                                    <div class="form-check d-flex mb-4">
                                        <input class="form-check-input me-2" type="checkbox" value="1"
                                            id="verify" name="verify" required />
                                        <label for="verify" class="form-check-label text-dark"> Are you sure you
                                            want to save these changes?
                                        </label>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" id="submitbtn" class="btn btn-lg btn-success w-100">Save
                                        Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
@endsection
