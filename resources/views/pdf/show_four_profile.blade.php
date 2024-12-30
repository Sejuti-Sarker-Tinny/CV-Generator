@extends('layouts.pdf')
@section('pdf_content')
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
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="wrapper">
                                <div class="sidebar-wrapper">
                                    <div class="profile-container">
                                    @if(isset($information['personal_info']['image_path']) && !empty($information['personal_info']['image_path']))
                                        <?php
                                            $imagePath = public_path('assets/images/' . $information['personal_info']['image_path']);
                                            $imageData = file_exists($imagePath) ? base64_encode(file_get_contents($imagePath)) : null;
                                        ?>
                                        <img class="profile box-image-preview img-fluid img-circle elevation-2"
                                            src="{{ $imageData ? 'data:image/png;base64,' . $imageData : asset('assets/images/user-thumb.jpg') }}"
                                            alt="" style="height:200px; width:200px;" />
                                    @else
                                        <img class="profile box-image-preview img-fluid img-circle elevation-2"
                                            src="{{ asset('assets/images/user-thumb.jpg') }}"
                                            alt="" style="height:200px; width:200px;" />
                                    @endif
                                        <h1 class="name">
                                            {{ isset($information['personal_info']['first_name']) ? $information['personal_info']['first_name'] : '' }}
                                            {{ isset($information['personal_info']['last_name']) ? $information['personal_info']['last_name'] : '' }}
                                        </h1>
                                        <h3 class="tagline">
                                            {{ isset($information['personal_info']['profile_title']) ? $information['personal_info']['profile_title'] : '' }}
                                        </h3>
                                    </div>
                                    <div class="contact-container container-block">
                                        <ul class="list-unstyled contact-list">
                                            @if (!empty($information['contact_info']['email']))
                                                <li class="email">
                                                    <a class="ms-3"
                                                        href="mailto: {{ isset($information['contact_info']['email']) ? $information['contact_info']['email'] : 'yourmail@example.com' }}">{{ isset($information['contact_info']['email']) ? $information['contact_info']['email'] : '' }}</a>
                                                </li>
                                            @endif
                                            @if (!empty($information['contact_info']['phone_number']))
                                                <li class="phone">
                                                    <a class="ms-3"
                                                        href="tel:{{ isset($information['contact_info']['phone_number']) ? $information['contact_info']['phone_number'] : '' }}">{{ isset($information['contact_info']['phone_number']) ? $information['contact_info']['phone_number'] : '' }}</a>
                                                </li>
                                            @endif
                                            @if (!empty($information['contact_info']['website']))
                                                <div style="display: flex; justify-content:space-between">
                                                    <div class="website">
                                                        <a class="ms-3"
                                                            href="{{ isset($information['contact_info']['website']) ? $information['contact_info']['website'] : '' }}"
                                                            target="_blank">{{ isset($information['contact_info']['website']) ? $information['contact_info']['website'] : '' }}</a>
                                                    </div>
                                                    <div class="website">
                                                        <a class="ms-3"
                                                            href="{{ isset($information['contact_info']['linkedin_link']) ? $information['contact_info']['linkedin_link'] : '' }}"
                                                            target="_blank">{{ isset($information['contact_info']['linkedin_link']) ? $information['contact_info']['linkedin_link'] : '' }}</a>
                                                    </div>
                                                    <div class="website">
                                                        <a class="ms-3"
                                                            href="{{ isset($information['contact_info']['github_link']) ? $information['contact_info']['github_link'] : '' }}"
                                                            target="_blank">{{ isset($information['contact_info']['github_link']) ? $information['contact_info']['github_link'] : '' }}</a>
                                                    </div>
                                                    <div class="website">
                                                        <a class="ms-3"
                                                            href="{{ isset($information['contact_info']['twitter']) ? $information['contact_info']['twitter'] : '' }}"
                                                            target="_blank">{{ isset($information['contact_info']['twitter']) ? $information['contact_info']['twitter'] : '' }}</a>
                                                    </div>
                                                </div>
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

                                    @if (!empty($information['language_info']))
                                        <div class="languages-container container-block">
                                            <h2 class="container-block-title">Languages</h2>
                                            <ul class="list-unstyled interests-list">
                                                @foreach ($information['language_info'] as $language_info)
                                                    <li>{{ isset($language_info['language']) ? $language_info['language'] : '' }}
                                                        <span class="lang-desc">
                                                            ({{ isset($language_info['language_level']) ? $language_info['language_level'] : '' }})
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!--//languages-->
                                    @endif

                                    @if (!empty($information['interest_info']))
                                        <div class="interests-container container-block">
                                            <h2 class="container-block-title">Interests</h2>
                                            <ul class="list-unstyled interests-list">
                                                @foreach ($information['interest_info'] as $interest_info)
                                                    <li>
                                                        {{ isset($interest_info['interest']) ? $interest_info['interest'] : '' }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!--//interests-->
                                    @endif
                                </div>
                                <!--//sidebar-wrapper-->

                                <div class="main-wrapper">
                                    <!-- @if (!empty($information['personal_info']['about_me']))
                                        <section class="section summary-section">
                                            <h2 class="section-title">
                                                <span class="icon-holder">
                                                </span>
                                                Career Profile
                                            </h2>
                                            <div class="summary">
                                                <p>
                                                    {{ isset($information['personal_info']['about_me']) ? $information['personal_info']['about_me'] : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis aliquam est harum minima dolorem nisi, et beatae dolorum atque eius necessitatibus molestiae perferendis, ipsum esse.' }}
                                                </p>
                                            </div>
                                            <!--//summary-->
                                        </section>
                                        <!--//section-->
                                    @endif 

                                    @if (!empty($information['experience_info']))
                                        <section class="section experiences-section">
                                            <h2 class="section-title">Experiences
                                                <span class="icon-holder">
                                                </span>
                                                
                                            </h2>
                                            @foreach ($information['experience_info'] as $experience_info)
                                                <div class="item">
                                                    <div class="meta">
                                                        <div class="upper-row">
                                                            <h3 class="job-title">
                                                                {{ isset($experience_info['job_title']) ? $experience_info['job_title'] : '' }}
                                                            </h3>
                                                            <div class="time">
                                                                {{ isset($experience_info['job_start_date']) ? $experience_info['job_start_date'] : '' }}
                                                                -
                                                                {{ isset($experience_info['job_end_date']) ? $experience_info['job_end_date'] : '' }}
                                                            </div>
                                                        </div>
                                                        <!--//upper-row-->
                                                        <div class="company">
                                                            {{ isset($experience_info['organization']) ? $experience_info['organization'] : '' }}
                                                        </div>
                                                    </div>
                                                    <!--//meta-->
                                                    <div class="details">
                                                        <p>{{ isset($experience_info['job_description']) ? $experience_info['job_description'] : '' }}
                                                        </p>
                                                    </div>
                                                    <!--//details-->
                                                </div>
                                                <!--//item-->
                                            @endforeach
                                        </section>
                                        <!--//section-->
                                    @endif

                                    @if (!empty($information['project_info']))
                                        <section class="section projects-section">
                                            <h2 class="section-title">Projects
                                                <span class="icon-holder">
                                                </span>
                                                
                                            </h2>
                                            @foreach ($information['project_info'] as $index => $project_info)
                                                <div class="item">
                                                    <span class="project-title">
                                                        <strong>{{ $index + 1 }}.</strong>
                                                        <a target="_blank">{{ isset($project_info['project_title']) ? $project_info['project_title'] : '' }}</a>
                                                    </span>
                                                    -
                                                    <span class="project-tagline">
                                                        {{ isset($project_info['project_description']) ? $project_info['project_description'] : '' }}
                                                    </span>
                                                </div>
                                                <!--//item-->
                                            @endforeach
                                        </section>
                                        <!--//section-->
                                    @endif

                                    @if (!empty($information['skill_info']))
                                        <section class="skills-section section">
                                            <h2 class="section-title">Skills
                                                &amp; Proficiency<span class="icon-holder">
                                                </span></h2>
                                            <div class="skillset">
                                                @foreach ($information['skill_info'] as $skill_info)
                                                    <div class="item">
                                                        <h3 class="level-title">
                                                            {{ isset($skill_info['skill_name']) ? $skill_info['skill_name'] : '' }}
                                                        </h3>
                                                    </div>
                                                    <!--//item-->
                                                @endforeach
                                            </div>
                                        </section>
                                        <!--//skills-section-->
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompdf/0.8.6/dompdf.js"></script>

    <script>
        $(document).ready(function () {
            $('#download-button').on('click', function () {
                // Clone the content to avoid any changes in the original HTML
                var contentClone = $('.content-wrapper').clone();

                // Create a new window with the cloned content
                var printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write('<html><head><title>PDF</title></head><body>');
                printWindow.document.write(contentClone.html());
                printWindow.document.write('</body></html>');
                printWindow.document.close();

                // Use Dompdf to generate a PDF
                dompdf = new Dompdf();
                dompdf.loadHtml(printWindow.document.documentElement.innerHTML);
                dompdf.render();

                // Get the generated PDF as a Blob
                dompdf.getOutput('blob').then(function (blob) {
                    // Create a download link and trigger the download
                    var link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'profile.pdf';
                    link.click();
                });
            });
        });
    </script>

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
    </script>
@endsection
