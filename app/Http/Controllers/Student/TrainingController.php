<?php

namespace App\Http\Controllers\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Content;
use App\Models\User;
class TrainingController extends Controller
{
    public function course_content() {
        $course_id = request()->course_id;

        $course_data = Courses::find($course_id);
        //dd($course_data);
        $course_content = null;
        $teacher = null;
        $teacher = $course_data->user_id;
        $teacher = User::find($teacher)->name;
        $course_content = $course_data->contents->sortBy('sort');
        //dd($teacher, $course_content, $course_data);
        return view('student.course_content', compact('course_data', 'teacher', 'course_content'));

    }
    public function get_result($token) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://localhost:2358/submissions/".$token."?base64_encoded=false&fields=*",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",

        ]);

        $response = curl_exec($curl);
        dd($response);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }




        /*
        oooooooooooooldddddddd
        $url = 'https://judge0-ce.p.rapidapi.com/submissions'.$token;
        //$url = 'http://localhost:2358/submissions/'.$token;
        //dd($url);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        //curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl); // результат запроса
        dd($result);
        return view('student.result');
        */
    }
    public function test_code() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://localhost:2358/submissions/?base64_encoded=true&fields=*",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{
            \"language_id\": 52,
            \"source_code\": \"I2luY2x1ZGUgPHN0ZGlvLmg+CgppbnQgbWFpbih2b2lkKSB7CiAgY2hhciBuYW1lWzEwXTsKICBzY2FuZigiJXMiLCBuYW1lKTsKICBwcmludGYoImhlbGxvLCAlc1xuIiwgbmFtZSk7CiAgcmV0dXJuIDA7Cn0=\",
            \"stdin\": \"SnVkZ2Uw\"
        }",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",

            ],
        ]);

        $response = curl_exec($curl);
        $result = json_decode($response);
        sleep(10);
        $this->get_result($result->token);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }


        //OLDDDDDDDD
        /*
        //$url = 'http://localhost:2358/submissions';
        $url = 'https://judge0-ce.p.rapidapi.com/submissions';
        //$headers = ['Content-Type: application/json']; // заголовки нашего запроса
        $headers = [
            'content-type' => 'application/json',
            'Content-Type' => 'application/json',
            'X-RapidAPI-Key' => '31b9530efemshd3253c6a256d1bep14a642jsn22da4e6e9825',
            'X-RapidAPI-Host' => 'judge0-ce.p.rapidapi.com'
        ];
        $post_data = [ // поля нашего запроса
            'language_id' => '52',
            'source_code' => "I2luY2x1ZGUgPHN0ZGlvLmg+CgppbnQgbWFpbih2b2lkKSB7CiAgY2hhciBuYW1lWzEwXTsKICBzY2FuZigiJXMiLCBuYW1lKTsKICBwcmludGYoImhlbGxvLCAlc1xuIiwgbmFtZSk7CiAgcmV0dXJuIDA7Cn0=",
            'stdin' => "SnVkZ2Uw"
        ];

        $data_json = json_encode($post_data); // переводим поля в формат JSON

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);

        $result = (curl_exec($curl));
        $result = json_decode($result); // результат POST запроса
        dd($result);
        $this->get_result($result->token);
        //dd($result);
        */

    }

    public function show_content() {
        $course_id = request()->course_id;
        $contents = Content::where('course_id', '=', $course_id)->paginate(1);
        $navbar = Content::where('course_id', '=', $course_id)->get();
        //dd($contents);
        return view('student.show_content', compact('contents', 'navbar'));
        /*
        if ($content->type_of_content == "task") {
            return view('student.show_task', compact('course_name', 'content', 'contents'));
        } else {
            return view('student.show_lecture', compact('course_name', 'content', 'contents'));
        }
        */
    }



}

