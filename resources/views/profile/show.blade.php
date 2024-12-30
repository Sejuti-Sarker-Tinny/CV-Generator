@extends('layouts.admin')
@section('admin_content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .cv-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile {
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 30px;
        }

        h2 {
            color: #333;
        }

        strong {
            color: #555;
        }

        .content {
            margin-top: 10px;
        }
    </style>
    <button id="downloadPdfButton" class="btn btn-primary ml-2">Download PDF</button>
    <button id="copyLinkButton" class="btn btn-primary ml-2">Copy Link</button>
    <div class="cv-container">

        <img class="profile box-image-preview img-fluid img-circle elevation-2"
            src="{{ isset($information['personal_info']['image_path']) && !empty($information['personal_info']['image_path']) ? asset('assets/images/' . $information['personal_info']['image_path']) : asset('assets/images/user-thumb.jpg') }}"
            alt="" style="height:200px; width:200px;" />

        <div class="section">
            <h2>Personal Information</h2>
            <div class="content">
                <p><strong>Name:</strong> {{ $information['personal_info']['first_name'] }} {{
                    $information['personal_info']['last_name'] }}</p>
                <p><strong>Profile Title:</strong> {{ $information['personal_info']['profile_title'] }}</p>
                <!-- Add more personal information fields as needed -->
            </div>
        </div>

        <div class="section">
            <h2>Contact Information</h2>
            <div class="content">
                <p><strong>Email:</strong> {{ $information['contact_info']['email'] }}</p>
                <p><strong>Phone Number:</strong> {{ $information['contact_info']['phone_number'] }}</p>
                <p><strong>website:</strong> {{ $information['contact_info']['website'] }}</p>
                <p><strong>Twitter:</strong> {{ $information['contact_info']['twitter'] }}</p>
                <p><strong>LinkedIn:</strong> {{ $information['contact_info']['linkedin_link'] }}</p>
                <p><strong>github:</strong> {{ $information['contact_info']['github_link'] }}</p>
                <!-- Add more contact information fields as needed -->
            </div>
        </div>

        <div class="section">
            <h2>Education</h2>
            <div class="content">
                @foreach($information['education_info'] as $education)
                <p><strong>{{ $education['degree_title'] }}</strong> - {{ $education['institute'] }}</p>
                <p>{{ $education['edu_start_date'] }} - {{ $education['edu_end_date'] }}</p>
                <p>{{ $education['education_description'] }}</p>
                @endforeach
                <!-- Add more education information fields as needed -->
            </div>
        </div>

        <div class="section">
            <h2>Experience</h2>
            <div class="content">
                @foreach($information['experience_info'] as $experience)
                <p><strong>{{ $experience['job_title'] }}</strong> - {{ $experience['organization'] }}</p>
                <p>{{ $experience['job_start_date'] }} - {{ $experience['job_end_date'] }}</p>
                <p>{{ $experience['job_description'] }}</p>
                @endforeach
                <!-- Add more experience information fields as needed -->
            </div>
        </div>

        <div class="section">
            <h2>Projects</h2>
            <div class="content">
                @foreach($information['project_info'] as $project)
                <p><strong>{{ $project['project_title'] }}</strong> - {{ $project['project_description'] }}</p>
                <!-- Add more project information fields as needed -->
                @endforeach
            </div>
        </div>

        <div class="section">
            <h2>Skills</h2>
            <div class="content">
                @foreach($information['skill_info'] as $skill)
                <p><strong>{{ $skill['skill_name'] }}</strong></p>
                <!-- Add more skill information fields as needed -->
                @endforeach
            </div>
        </div>

        <div class="section">
            <h2>Languages</h2>
            <div class="content">
                @foreach($information['language_info'] as $language)
                <p><strong>{{ $language['language'] }}</strong> - {{ $language['language_level'] }}</p>
                <!-- Add more language information fields as needed -->
                @endforeach
            </div>
        </div>

        <div class="section">
            <h2>Interests</h2>
            <div class="content">
                @foreach($information['interest_info'] as $interest)
                <p>{{ $interest['interest'] }}</p>
                <!-- Add more interest information fields as needed -->
                @endforeach
            </div>
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
            window.location.href = '{{ route("download-pdf", ["id" => $information['personal_info']['user_id']]) }}';
        });
    </script>
@endsection
