@extends('layouts.pdf')
@section('pdf_content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .cv-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .profile {
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        h2 {
            color: #007bff;
        }

        strong {
            color: #343a40;
        }

        .content p {
            margin: 5px 0;
        }
    </style>
    <div class="cv-container">

        <div class="card p-2">
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

            <h2>Personal Information</h2>
            <div class="content">
                <p><strong>Name:</strong> {{ $information['personal_info']['first_name'] }} {{
                    $information['personal_info']['last_name'] }}</p>
                <p><strong>Profile Title:</strong> {{ $information['personal_info']['profile_title'] }}</p>
                <!-- Add more personal information fields as needed -->
            </div>
        </div>

        <div class="card p-2">
            <h2>Contact Information</h2>
            <div class="content">
                <p><strong>Email:</strong> {{ $information['contact_info']['email'] }}</p>
                <p><strong>Phone Number:</strong> {{ $information['contact_info']['phone_number'] }}</p>
                <!-- Add more contact information fields as needed -->
            </div>
        </div>

        <div class="card p-2">
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

        <div class="card p-2">
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

        <div class="card p-2">
            <h2>Projects</h2>
            <div class="content">
                @foreach($information['project_info'] as $project)
                <p><strong>{{ $project['project_title'] }}</strong> - {{ $project['project_description'] }}</p>
                <!-- Add more project information fields as needed -->
                @endforeach
            </div>
        </div>

        <div class="card p-2">
            <h2>Skills</h2>
            <div class="content">
                @foreach($information['skill_info'] as $skill)
                <p><strong>{{ $skill['skill_name'] }}</strong></p>
                <!-- Add more skill information fields as needed -->
                @endforeach
            </div>
        </div>

        <div class="card p-2">
            <h2>Languages</h2>
            <div class="content">
                @foreach($information['language_info'] as $language)
                <p><strong>{{ $language['language'] }}</strong> - {{ $language['language_level'] }}</p>
                <!-- Add more language information fields as needed -->
                @endforeach
            </div>
        </div>

        <div class="card p-2">
            <h2>Interests</h2>
            <div class="content">
                @foreach($information['interest_info'] as $interest)
                <p>{{ $interest['interest'] }}</p>
                <!-- Add more interest information fields as needed -->
                @endforeach
            </div>
        </div>

    </div>
@endsection
