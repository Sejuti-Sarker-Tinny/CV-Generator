@extends('layouts.admin')
@section('admin_content')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .card-body {
            padding: 20px;
        }

        .profile-container {
            text-align: center;
        }

        .profile {
            border: 4px solid #fff;
        }

        .name {
            margin-top: 10px;
            font-size: 1.5rem;
        }

        .tagline {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .contact-list li {
            margin-bottom: 10px;
        }

        .container-block {
            margin-bottom: 30px;
        }

        .container-block-title {
            font-size: 1.5rem;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .summary-section p {
            font-size: 1.1rem;
        }

        .experiences-section,
        .projects-section,
        .skills-section {
            margin-bottom: 30px;
        }

        .experiences-section .item,
        .projects-section .item,
        .skills-section .item {
            margin-bottom: 20px;
        }

        .skillset {
            display: flex;
            flex-wrap: wrap;
        }

        .skillset .item {
            width: calc(33.333% - 20px);
            margin-right: 20px;
        }

        .level-title {
            margin-bottom: 5px;
        }

        .progress {
            height: 8px;
            margin-bottom: 10px;
        }

        .theme-progress-bar {
            background-color: #007bff;
        }

        .section-title {
            position: relative;
        }

        .section-title span.icon-holder {
            display: inline-block;
            margin-right: 10px;
        }

        /* Media Query for responsiveness */

        @media (max-width: 768px) {
            .sidebar-wrapper {
                margin-bottom: 30px;
            }

            .main-wrapper {
                width: 100%;
            }

            .skillset .item {
                width: 100%;
                margin-right: 0;
            }
        }

        .content-wrapper {
            margin-top: 4rem;
        }

        .download-buttons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1rem;
        }
    </style>
    <button id="downloadPdfButton" class="btn btn-primary ml-2">Download PDF</button>
    <button id="copyLinkButton" class="btn btn-primary ml-2">Copy Link</button>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ isset($information['personal_info']['first_name']) ? $information['personal_info']['first_name'] : 'Empty' }}
                                {{ isset($information['personal_info']['last_name']) ? $information['personal_info']['last_name'] : '' }}'s
                                Bio Data
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="wrapper">
                                <div class="sidebar-wrapper">
                                    <div class="profile-container">
                                        <img class="profile box-image-preview img-fluid img-circle elevation-2"
                                            src="{{ isset($information['personal_info']['image_path']) && !empty($information['personal_info']['image_path']) ? asset('assets/images/' . $information['personal_info']['image_path']) : asset('assets/images/user-thumb.jpg') }}"
                                            alt="" style="height:200px; width:200px;" />
                                        <h1 class="name">
                                            {{ isset($information['personal_info']['first_name']) ? $information['personal_info']['first_name'] : '' }}
                                            {{ isset($information['personal_info']['last_name']) ? $information['personal_info']['last_name'] : '' }}
                                        </h1>
                                        <h1 class="name">
                                            Father's Name:
                                            {{ isset($information['personal_info']['father_name']) ? $information['personal_info']['father_name'] : '' }}
                                        </h1>
                                        <h1 class="name">
                                            Mothers's Name:
                                            {{ isset($information['personal_info']['mother_name']) ? $information['personal_info']['mother_name'] : '' }}
                                        </h1>
                                    </div>
                                    <div class="contact-container container-block">
                                        <ul class="list-unstyled contact-list">
                                            @if (!empty($information['personal_info']['email']))
                                                <li class="email">
                                                    Email
                                                    <a class="ms-3"
                                                        href="mailto: {{ isset($information['personal_info']['email']) ? $information['personal_info']['email'] : 'yourmail@example.com' }}">{{ isset($information['personal_info']['email']) ? $information['personal_info']['email'] : '' }}</a>
                                                </li>
                                            @endif
                                            @if (!empty($information['personal_info']['phone_number']))
                                                <li class="phone">
                                                    Phone Number
                                                    <a class="ms-3"
                                                        href="tel:{{ isset($information['personal_info']['phone_number']) ? $information['personal_info']['phone_number'] : '' }}">{{ isset($information['personal_info']['phone_number']) ? $information['personal_info']['phone_number'] : '' }}</a>
                                                </li>
                                            @endif
                                            @if (!empty($information['personal_info']['phone_number']))
                                                <li class="phone">
                                                    Date of Birth:
                                                    <a class="ms-3"
                                                        href="tel:{{ isset($information['personal_info']['dob']) ? $information['personal_info']['dob'] : '' }}">{{ isset($information['personal_info']['dob']) ? $information['personal_info']['dob'] : '' }}</a>
                                                </li>
                                            @endif
                                            @if (!empty($information['personal_info']['phone_number']))
                                                <li class="phone">
                                                    NID Number:
                                                    <a class="ms-3"
                                                        href="tel:{{ isset($information['personal_info']['nid']) ? $information['personal_info']['nid'] : '' }}">{{ isset($information['personal_info']['nid']) ? $information['personal_info']['nid'] : '' }}</a>
                                                </li>
                                            @endif
                                            @if (!empty($information['personal_info']['phone_number']))
                                                <li class="phone">
                                                    Religion
                                                    <a class="ms-3"
                                                        href="tel:{{ isset($information['personal_info']['religion']) ? $information['personal_info']['religion'] : '' }}">{{ isset($information['personal_info']['religion']) ? $information['personal_info']['religion'] : '' }}</a>
                                                </li>
                                            @endif
                                            @if (!empty($information['personal_info']['phone_number']))
                                                <li class="phone">
                                                    Gender
                                                    <a class="ms-3"
                                                        href="tel:{{ isset($information['personal_info']['gender']) ? $information['personal_info']['gender'] : '' }}">{{ isset($information['personal_info']['gender']) ? $information['personal_info']['gender'] : '' }}</a>
                                                </li>
                                            @endif
                                            @if (!empty($information['personal_info']['phone_number']))
                                                <li class="phone">
                                                    Nationality
                                                    <a class="ms-3"
                                                        href="tel:{{ isset($information['personal_info']['nationality']) ? $information['personal_info']['nationality'] : '' }}">{{ isset($information['personal_info']['nationality']) ? $information['personal_info']['nationality'] : '' }}</a>
                                                </li>
                                            @endif
                                            @if (!empty($information['personal_info']['phone_number']))
                                                <li class="phone">
                                                    Marital Status
                                                    <a class="ms-3"
                                                        href="tel:{{ isset($information['personal_info']['marital_sttaus']) ? $information['personal_info']['marital_sttaus'] : '' }}">{{ isset($information['personal_info']['marital_sttaus']) ? $information['personal_info']['marital_sttaus'] : '' }}</a>
                                                </li>
                                            @endif
                                            <!-- ... (add more contact list items) ... -->
                                        </ul>
                                    </div>
                                    <!--//contact-container-->

                                    @if (!empty($information['education_info']))
                                        <div class="education-container container-block">
                                            <h2 class="container-block-title">Education</h2>
                                            @foreach ($information['education_info'] as $education_info)
                                                <div class="item">
                                                    <h4 class="degree">
                                                        {{ isset($education_info['degree_title']) ? $education_info['degree_title'] : '' }}
                                                    </h4>
                                                    <h5 class="meta">
                                                        {{ isset($education_info['institute']) ? $education_info['institute'] : '' }}
                                                    </h5>
                                                    <div class="time">
                                                        {{ isset($education_info['edu_start_date']) ? $education_info['edu_start_date'] : '' }}
                                                        -
                                                        {{ isset($education_info['edu_end_date']) ? $education_info['edu_end_date'] : '' }}
                                                    </div>
                                                    <p>{{ isset($education_info['education_description']) ? $education_info['education_description'] : '' }}
                                                    </p>
                                                </div>
                                            @endforeach
                                            <!--//item-->
                                        </div>
                                        <!--//education-container-->
                                    @endif
                                </div>
                                <!--//sidebar-wrapper-->

                                <div class="main-wrapper">
                                    @if (!empty($information['experience_info']))
                                        <section class="section experiences-section">
                                            <h2 class="section-title">
                                                <span class="icon-holder">
                                                </span>
                                                Experiences
                                            </h2>
                                            @foreach ($information['experience_info'] as $experience_info)
                                                <div class="item">
                                                    <div class="meta">
                                                        <div class="upper-row">
                                                            <h3 class="job-title">
                                                                {{ isset($experience_info['job_title']) ? $experience_info['job_title'] : '' }}
                                                            </h3>
                                                        </div>
                                                        <!--//upper-row-->
                                                        <div class="company">
                                                            {{ isset($experience_info['organization']) ? $experience_info['organization'] : '' }}
                                                        </div>
                                                    </div>
                                                    <!--//meta-->
                                                    <!--//details-->
                                                </div>
                                                <!--//item-->
                                            @endforeach
                                        </section>
                                        <!--//section-->
                                    @endif
                                </div>
                                <!--//main-body-->
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>

    <script>
        document.getElementById('copyLinkButton').addEventListener('click', function() {
            var currentUrl = window.location.href;

            var tempInput = document.createElement('input');
            tempInput.value = currentUrl;

            document.body.appendChild(tempInput);

            tempInput.select();
            tempInput.setSelectionRange(0, 99999);

            document.execCommand('copy');

            document.body.removeChild(tempInput);

            alert('Link copied to clipboard: ' + currentUrl);
        });

        document.getElementById('downloadPdfButton').addEventListener('click', function () {
            // Redirect to the download PDF route with the user ID
            window.location.href = '{{ route("download-pdf-four-bio", ["id" => $information['personal_info']['user_id']]) }}';
        });
    </script>
@endsection
