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
                @endforeach
                <!-- Add more experience information fields as needed -->
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
            window.location.href = '{{ route("download-pdf-bio", ["id" => $information['personal_info']['user_id']]) }}';
        });
    </script>
@endsection
