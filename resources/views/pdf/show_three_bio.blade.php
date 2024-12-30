@extends('layouts.pdf')
@section('pdf_content')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            line-height: 1.6;
        }

        .content-wrapper {
            margin-top: 50px;
        }

        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-title {
            margin: 0;
            font-size: 24px;
        }

        .card-body {
            padding: 30px;
        }

        .profile-container {
            text-align: center;
        }

        .name {
            font-size: 24px;
            margin: 10px 0;
        }

        .tagline {
            color: #777;
            font-size: 18px;
        }

        .contact-list li {
            margin-bottom: 10px;
        }

        .container-block {
            margin-bottom: 30px;
        }

        .container-block-title {
            font-size: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #007bff;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 30px;
            color: #007bff;
        }

        .summary-section p {
            font-size: 16px;
        }

        .experiences-section .item,
        .projects-section .item {
            margin-bottom: 30px;
        }

        .item .meta {
            margin-bottom: 15px;
        }

        .meta .job-title {
            font-size: 20px;
            margin: 0;
        }

        .details p {
            font-size: 16px;
        }

        .skills-section .level-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .level-bar {
            height: 20px;
            background-color: #ddd;
            border-radius: 5px;
        }

        .theme-progress-bar {
            background-color: #007bff;
            border-radius: 5px;
        }
    </style>
    <div class="content-wrapper mt-4r">
<div>
    
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
            <p><strong>Fathers's Name:</strong> {{ $information['personal_info']['father_name'] }}</p>
            <p><strong>Mother's Name:</strong> {{ $information['personal_info']['mother_name'] }}</p>
            <p><strong>Phone Number:</strong> {{ $information['personal_info']['phone_number'] }}</p>
            <p><strong>email:</strong> {{ $information['personal_info']['email'] }}</p>
            <p><strong>Date of Birth:</strong> {{ $information['personal_info']['dob'] }}</p>
            <p><strong>NID Number:</strong> {{ $information['personal_info']['nid'] }}</p>
            <p><strong>NID Number:</strong> {{ $information['personal_info']['religion'] }}</p>
            <p><strong>Marital Status:</strong> {{ $information['personal_info']['marital_sttaus'] }}</p>
            <p><strong>Gender:</strong> {{ $information['personal_info']['gender'] }}</p>
            <p><strong>Nationality:</strong> {{ $information['personal_info']['nationality'] }}</p>
            <p><strong>Address:</strong> {{ $information['personal_info']['address'] }}</p>
            <!-- Add more personal information fields as needed -->
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
            @endforeach
            <!-- Add more experience information fields as needed -->
        </div>
    </div>
</div>

    </div>

@endsection
