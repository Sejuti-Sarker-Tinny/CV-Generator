<?php

namespace App\Http\Controllers;

use App\Models\Edu;
use App\Models\Exp;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Dompdf\Options;

class BioController extends Controller
{
    public function index()
    {
        // Retrieve the currently authenticated user
        $authenticatedUser = auth()->user();

        // Check if the authenticated user exists
        if ($authenticatedUser) {
            // Retrieve all personal information records for the authenticated user
            $personal_information = PersonalInfo::where('user_id', $authenticatedUser->id)->get();

            // Check if personal information exists
            if ($personal_information->isNotEmpty()) {
                // Initialize an array to store user data
                $user_data = [];

                // Loop through each personal information record
                foreach ($personal_information as $personal_info) {
                    // Retrieve additional related information for the user
                    $education_info = Edu::where('user_id', $authenticatedUser->id)->first();
                    $experience_info = Exp::where('user_id', $authenticatedUser->id)->first();

                    // Organize the user data into an array
                    $user_info = [
                        'personal_info' => $personal_info->toArray(),
                        'education_info' => $education_info ? $education_info->toArray() : [],
                        'experience_info' => $experience_info ? $experience_info->toArray() : [],
                    ];

                    // Push the user_info array into the user_data array
                    $user_data[] = $user_info;
                }

                // Pass the user data to the 'bio.index' view
                return view('bio.index', ['users_data' => $user_data]);
            }
        }

        // If the authenticated user or personal information does not exist, return an empty view or redirect as needed.
        return view('bio.index', ['users_data' => []]);
    }

    public function view($id)
    {
        if (!empty($id)) {
            $personal_information       = PersonalInfo::where('user_id', $id)->first()->toArray();
            $education_information      = Edu::where('user_id', $id)->get()->toArray();
            $experience_information     = Exp::where('user_id', $id)->get()->toArray();

            $info['personal_info']      = $personal_information;
            $info['education_info']     = $education_information;
            $info['experience_info']    = $experience_information;
        }

        return view('bio.show', ['information' => $info]);
    }

    public function view_two($id)
    {
        if (!empty($id)) {
            $personal_information       = PersonalInfo::where('user_id', $id)->first()->toArray();
            $education_information      = Edu::where('user_id', $id)->get()->toArray();
            $experience_information     = Exp::where('user_id', $id)->get()->toArray();

            $info['personal_info']      = $personal_information;
            $info['education_info']     = $education_information;
            $info['experience_info']    = $experience_information;
        }

        return view('bio.show_two', ['information' => $info]);
    }

    public function view_three($id)
    {
        if (!empty($id)) {
            $personal_information       = PersonalInfo::where('user_id', $id)->first()->toArray();
            $education_information      = Edu::where('user_id', $id)->get()->toArray();
            $experience_information     = Exp::where('user_id', $id)->get()->toArray();

            $info['personal_info']      = $personal_information;
            $info['education_info']     = $education_information;
            $info['experience_info']    = $experience_information;
        }

        return view('bio.show_three', ['information' => $info]);
    }

    public function view_four($id)
    {
        if (!empty($id)) {
            $personal_information       = PersonalInfo::where('user_id', $id)->first()->toArray();
            $education_information      = Edu::where('user_id', $id)->get()->toArray();
            $experience_information     = Exp::where('user_id', $id)->get()->toArray();

            $info['personal_info']      = $personal_information;
            $info['education_info']     = $education_information;
            $info['experience_info']    = $experience_information;
        }

        return view('bio.show_four', ['information' => $info]);
    }

    public function create()
    {
        return view('bio.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();

        $personal_info = new PersonalInfo();
        $personal_info->user_id = $user_id;
        $personal_info->first_name        = $request->first_name;
        $personal_info->last_name         = $request->last_name;
        $personal_info->father_name         = $request->father_name;
        $personal_info->mother_name         = $request->mother_name;
        $personal_info->email            = $request->email;
        $personal_info->phone_number     = $request->phone_number;
        $personal_info->nid     = $request->nid;
        $personal_info->religion     = $request->religion;
        $personal_info->marital_sttaus     = $request->marital_sttaus;
        $personal_info->gender     = $request->gender;
        $personal_info->nationality     = $request->nationality;
        $personal_info->dob     = $request->dob;
        $personal_info->address     = $request->address;
        if ($request->file('image_path')) {
            $picture       = !empty($request->file('image_path')) ? $request->file('image_path')->getClientOriginalName() : '';
            $request->file('image_path')->move(public_path('assets/images/'), $picture);
        }
        $personal_info->image_path        = isset($picture) && !empty($picture) ? $picture : '';
        $personal_info->save();

        $personal_information = PersonalInfo::latest()->first();


        $edu_count = count($request->degree_title);
        if ($edu_count != 0) {
            for ($i = 0; $i < $edu_count; $i++) {

                $education_info = new Edu();
                $education_info->user_id                = $user_id;
                $education_info->degree_title           = $request->degree_title[$i];
                $education_info->institute              = $request->institute[$i];
                $education_info->edu_start_date         = $request->edu_start_date[$i];
                $education_info->edu_end_date           = $request->edu_end_date[$i];
                $education_info->education_description  = $request->education_description[$i];
                $education_info->save();
            }
        }


        $exp_count = count($request->job_title);
        if ($exp_count != 0) {
            for ($i = 0; $i < $exp_count; $i++) {

                $experience_info = new Exp();
                $experience_info->user_id          = $user_id;
                $experience_info->job_title        = $request->job_title[$i];
                $experience_info->organization     = $request->organization[$i];
                $experience_info->save();
            }
        }

        return redirect()->route('bio.index')->withSuccess("User Bio Data created successfully");
    }

    public function edit($id)
    {
        if (!empty($id)) {
            $personal_information       = PersonalInfo::where('user_id', $id)->get()->first()->toArray();
            $education_information      = Edu::where('user_id', $id)->get()->toArray();
            $experience_information     = Exp::where('user_id', $id)->get()->toArray();

            $info['personal_info']      = $personal_information;
            $info['education_info']     = $education_information;
            $info['experience_info']    = $experience_information;

            return view('bio.edit', ['information' => $info]);
        } else {
            return redirect()->back()->withErrors('Somthing went wrong');
        }
    }

    public function update(Request $request)
    {

        if ($request->verify == 1) {
            $id = $request->user_id;

            $personal_info = PersonalInfo::where('user_id', $id)->first();
            $personal_info->first_name        = $request->first_name;
            $personal_info->last_name         = $request->last_name;
            $personal_info->father_name         = $request->father_name;
            $personal_info->mother_name         = $request->mother_name;
            $personal_info->email            = $request->email;
            $personal_info->phone_number     = $request->phone_number;
            $personal_info->nid     = $request->nid;
            $personal_info->religion     = $request->religion;
            $personal_info->marital_sttaus     = $request->marital_sttaus;
            $personal_info->gender     = $request->gender;
            $personal_info->nationality     = $request->nationality;
            $personal_info->dob     = $request->dob;
            $personal_info->address     = $request->address;
            if ($request->file('image_path')) {
                $picture       = !empty($request->file('image_path')) ? $request->file('image_path')->getClientOriginalName() : '';
                $request->file('image_path')->move(public_path('assets/images/'), $picture);
            }
            if (!empty($request->file('image_path'))) {
                $personal_info->image_path        = isset($picture) && !empty($picture) ? $picture : '';
            }
            $personal_info->save();


            $education_info     = Edu::where('user_id', $id)->get();
            $edu_count_local    = !empty($request->degree_title) ? count($request->degree_title) : 0;
            $edu_count_live     = count($education_info);

            $edu_count_live >= $edu_count_local ? $edu_count = $edu_count_live : $edu_count = $edu_count_local;

            if ($edu_count != 0) {
                for ($i = 0; $i < $edu_count; $i++) {

                    if ($edu_count_local > 0 && $edu_count_live <= 0) {

                        $edu_info = new Edu();
                        $edu_info->user_id                = $id;
                        $edu_info->degree_title           = $request->degree_title[$i];
                        $edu_info->institute              = $request->institute[$i];
                        $edu_info->edu_start_date         = $request->edu_start_date[$i];
                        $edu_info->edu_end_date           = $request->edu_end_date[$i];
                        $edu_info->education_description  = $request->education_description[$i];
                        $edu_info->save();
                    } elseif ($edu_count_live > 0 && $edu_count_local <= 0
                    ) {

                        Edu::find($education_info[$i]['user_id'])->delete();
                    } else {

                        $education_info[$i]->user_id                = $id;
                        $education_info[$i]->degree_title           = $request->degree_title[$i];
                        $education_info[$i]->institute              = $request->institute[$i];
                        $education_info[$i]->edu_start_date         = $request->edu_start_date[$i];
                        $education_info[$i]->edu_end_date           = $request->edu_end_date[$i];
                        $education_info[$i]->education_description  = $request->education_description[$i];
                        $education_info[$i]->save();
                    }

                    $edu_count_local--;
                    $edu_count_live--;
                }
            }



            $experience_info    = Exp::where('user_id', $id)->get();
            $exp_count_local    = !empty($request->job_title) ? count($request->job_title) : 0;
            $exp_count_live     = count($experience_info);

            $exp_count_live >= $exp_count_local ? $exp_count = $exp_count_live : $exp_count = $exp_count_local;

            if ($exp_count != 0) {
                for ($i = 0; $i < $exp_count; $i++) {

                    if ($exp_count_local > 0 && $exp_count_live <= 0) {

                        $exp_info = new Exp();
                        $exp_info->user_id          = $id;
                        $exp_info->job_title        = $request->job_title[$i];
                        $exp_info->organization     = $request->organization[$i];
                        $exp_info->save();
                    } elseif ($exp_count_live > 0 && $exp_count_local <= 0) {

                        Exp::find($experience_info[$i]['user_id'])->delete();
                    } else {
                        $experience_info[$i]->user_id          = $id;
                        $experience_info[$i]->job_title        = $request->job_title[$i];
                        $experience_info[$i]->organization     = $request->organization[$i];
                        $experience_info[$i]->save();
                    }

                    $exp_count_local--;
                    $exp_count_live--;
                }
            }
        }

        return redirect()->back()->withSuccess("User Bio Data updated successfully");
    }

    public function destroy($id)
    {
        // dd($id);
        if (!empty($id)) {
            PersonalInfo::where('user_id', $id)->delete();
            Edu::where('user_id', $id)->delete();
            Exp::where('user_id', $id)->delete();

            return redirect()->back()->withSuccess("User Bio data deleted successfully");
        } else {
            return redirect()->back()->withSuccess("Something went wrong");
        }
    }

    public function downloadPDF($id)
    {
        if (!empty($id)) {
            $personal_information = PersonalInfo::where('user_id', $id)->first()->toArray();
            $education_information = Edu::where('user_id', $id)->get()->toArray();
            $experience_information = Exp::where('user_id', $id)->get()->toArray();

            $info['personal_info']['image_path'] = asset('assets/images/' . $personal_information['image_path']);
            $info['personal_info'] = $personal_information;
            $info['education_info'] = $education_information;
            $info['experience_info'] = $experience_information;

            // Create a Dompdf instance
            $dompdf = new Dompdf();

            // Load your Blade view into Dompdf
            $html = View::make('pdf.show_bio', ['information' => $info])->render();
            $dompdf->loadHtml($html);

            // (Optional) Set options
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $dompdf->setOptions($options);

            // Load the HTML content
            $dompdf->loadHtml($html);

            // (Optional) Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Stream the file to the browser
            return $dompdf->stream('user_bio.pdf');
        }

        // Handle the case where the user ID is not provided
        return redirect()->route('index')->withErrors("User ID not provided");
    }

    public function downloadPDFTwo($id)
    {
        if (!empty($id)) {
            $personal_information = PersonalInfo::where('user_id', $id)->first()->toArray();
            $education_information = Edu::where('user_id', $id)->get()->toArray();
            $experience_information = Exp::where('user_id', $id)->get()->toArray();

            $info['personal_info']['image_path'] = asset('assets/images/' . $personal_information['image_path'] . '.jpg');
            $info['personal_info'] = $personal_information;
            $info['education_info'] = $education_information;
            $info['experience_info'] = $experience_information;

            // Create a Dompdf instance
            $dompdf = new Dompdf();

            // Load your Blade view into Dompdf
            $html = View::make('pdf.show_two_bio', ['information' => $info])->render();
            $dompdf->loadHtml($html);

            // (Optional) Set options
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $dompdf->setOptions($options);

            // Load the HTML content
            $dompdf->loadHtml($html);

            // (Optional) Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Stream the file to the browser
            return $dompdf->stream('user_bio.pdf');
        }

        // Handle the case where the user ID is not provided
        return redirect()->route('index')->withErrors("User ID not provided");
    }

    public function downloadPDFThree($id)
    {
        if (!empty($id)) {
            $personal_information = PersonalInfo::where('user_id', $id)->first()->toArray();
            $education_information = Edu::where('user_id', $id)->get()->toArray();
            $experience_information = Exp::where('user_id', $id)->get()->toArray();

            $info['personal_info']['image_path'] = asset('assets/images/' . $personal_information['image_path'] . '.jpg');
            $info['personal_info'] = $personal_information;
            $info['education_info'] = $education_information;
            $info['experience_info'] = $experience_information;

            // Create a Dompdf instance
            $dompdf = new Dompdf();

            // Load your Blade view into Dompdf
            $html = View::make('pdf.show_three_bio', ['information' => $info])->render();
            $dompdf->loadHtml($html);

            // (Optional) Set options
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $dompdf->setOptions($options);

            // Load the HTML content
            $dompdf->loadHtml($html);

            // (Optional) Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Stream the file to the browser
            return $dompdf->stream('user_bio.pdf');
        }

        // Handle the case where the user ID is not provided
        return redirect()->route('index')->withErrors("User ID not provided");
    }

    public function downloadPDFFour($id)
    {
        if (!empty($id)) {
            $personal_information = PersonalInfo::where('user_id', $id)->first()->toArray();
            $education_information = Edu::where('user_id', $id)->get()->toArray();
            $experience_information = Exp::where('user_id', $id)->get()->toArray();

            $info['personal_info']['image_path'] = asset('assets/images/' . $personal_information['image_path'] . '.jpg');
            $info['personal_info'] = $personal_information;
            $info['education_info'] = $education_information;
            $info['experience_info'] = $experience_information;

            // Create a Dompdf instance
            $dompdf = new Dompdf();

            // Load your Blade view into Dompdf
            $html = View::make('pdf.show_four_bio', ['information' => $info])->render();
            $dompdf->loadHtml($html);

            // (Optional) Set options
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $dompdf->setOptions($options);

            // Load the HTML content
            $dompdf->loadHtml($html);

            // (Optional) Set paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Stream the file to the browser
            return $dompdf->stream('user_bio.pdf');
        }

        // Handle the case where the user ID is not provided
        return redirect()->route('index')->withErrors("User ID not provided");
    }

}
