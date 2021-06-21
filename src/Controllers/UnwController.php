<?php

namespace edgewizz\unw\Controllers;
use App\Http\Controllers\Controller;
use Edgewizz\Edgecontent\Models\ProblemSet;
use Edgewizz\Edgecontent\Models\ProblemSetQues;
use Edgewizz\Unw\Models\UnwAns;
use Edgewizz\Unw\Models\UnwQues;
use Illuminate\Http\Request;

class UnwController extends Controller
{
    //
    public function test(){
        dd('hello');
    }
    public function store(Request $request){
        $unwQ = new UnwQues();
        $unwQ->question = $request->question;
        $unwQ->format_title = $request->format_title;
        $unwQ->difficulty_level_id = $request->difficulty_level_id;
        $unwQ->hint = $request->hint;
        $unwQ->save();
        /* answer1 */
        if($request->answer1){
            $ans1 = new UnwAns();
            $ans1->question_id = $unwQ->id;
            $ans1->answer = $request->answer1;
            $ans1->arrange = $request->arrange1;
            $ans1->eng_word = $request->eng_word1;
            $ans1->save();
        }
        /* answer1 */
        /* answer2 */
        if($request->answer2){
            $ans2 = new UnwAns();
            $ans2->question_id = $unwQ->id;
            $ans2->answer = $request->answer2;
            $ans2->arrange = $request->arrange2;
            $ans2->eng_word = $request->eng_word2;
            $ans2->save();
        }
        /* answer2 */
        /* answer3 */
        if($request->answer3){
            $ans3 = new UnwAns();
            $ans3->question_id = $unwQ->id;
            $ans3->answer = $request->answer3;
            $ans3->arrange = $request->arrange3;
            $ans3->eng_word = $request->eng_word3;
            $ans3->save();
        }
        /* answer3 */
        /* answer4 */
        if($request->answer4){
            $ans4 = new UnwAns();
            $ans4->question_id = $unwQ->id;
            $ans4->answer = $request->answer4;
            $ans4->arrange = $request->arrange4;
            $ans4->eng_word = $request->eng_word4;
            $ans4->save();
        }
        /* answer4 */
        /* answer5 */
        if($request->answer5){
            $ans5 = new UnwAns();
            $ans5->question_id = $unwQ->id;
            $ans5->answer = $request->answer5;
            $ans5->arrange = $request->arrange5;
            $ans5->eng_word = $request->eng_word5;
            $ans5->save();
        }
        /* answer5 */
        /* answer6 */
        if($request->answer6){
            $ans6 = new UnwAns();
            $ans6->question_id = $unwQ->id;
            $ans6->answer = $request->answer6;
            $ans6->arrange = $request->arrange6;
            $ans6->eng_word = $request->eng_word6;
            $ans6->save();
        }
        /* answer6 */
        /* answer7 */
        if($request->answer7){
            $ans7 = new UnwAns();
            $ans7->question_id = $unwQ->id;
            $ans7->answer = $request->answer7;
            $ans7->arrange = $request->arrange7;
            $ans7->eng_word = $request->eng_word7;
            $ans7->save();
        }
        /* answer7 */        
        /* answer8 */
        if($request->answer8){
            $ans8 = new UnwAns();
            $ans8->question_id = $unwQ->id;
            $ans8->answer = $request->answer8;
            $ans8->arrange = $request->arrange8;
            $ans8->eng_word = $request->eng_word8;
            $ans8->save();
        }
        /* answer8 */
        /* answer9 */
        if($request->answer9){
            $ans9 = new UnwAns();
            $ans9->question_id = $unwQ->id;
            $ans9->answer = $request->answer9;
            $ans9->arrange = $request->arrange9;
            $ans9->eng_word = $request->eng_word9;
            $ans9->save();
        }
        /* answer9 */
        /* answer10 */
        if($request->answer10){
            $ans10 = new UnwAns();
            $ans10->question_id = $unwQ->id;
            $ans10->answer = $request->answer10;
            $ans10->arrange = $request->arrange10;
            $ans10->eng_word = $request->eng_word10;
            $ans10->save();
        }
        /* answer10 */
        if($request->problem_set_id && $request->format_type_id){
            $pbq = new ProblemSetQues();
            $pbq->problem_set_id = $request->problem_set_id;
            $pbq->question_id = $unwQ->id;
            $pbq->format_type_id = $request->format_type_id;
            $pbq->save();
        }
        return back();
    }
    public function edit($id, Request $request){
        
    }

    public function update($id, Request $request){
        $q = UnwQues::where('id', $id)->first();
        $q->question = $request->question;
        $q->difficulty_level_id = $request->difficulty_level_id;
        if($request->format_title){
            $q->format_title = $request->format_title;
        }
        $q->hint = $request->hint;
        $q->save();
        $answers = UnwAns::where('question_id', $q->id)->get();
        foreach($answers as $ans){
            if($request->ans.$ans->id){
                $inputAnswer = 'answer'.$ans->id;
                $inputArrange = 'arrange'.$ans->id;
                $inputEngWord = 'eng_word'.$ans->id;
                $ans->answer = $request->$inputAnswer;
                $ans->arrange = $request->$inputArrange;
                $ans->eng_word = $request->$inputEngWord;
                $ans->save();
            }
        }
        return back();
    }

    public function uploadFile(Request $request)
    {
            $file = $request->file('file');
            // dd($file);
            // File Details
            $filename = time().$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            // Valid File Extensions
            $valid_extension = array("csv");
            // 2MB in Bytes
            $maxFileSize = 2097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'uploads/unw';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                        $num = count($filedata);
                        // Skip first row (Remove below comment if you want to skip the first row)
                        if($i == 0){
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);
                    // Insert to MySQL database
                    foreach ($importData_arr as $importData) {
                        $insertData = array(
                                "question"      => $importData[1],

                                "answer1"       => $importData[2],
                                "arrange1"      => $importData[3],
                                "eng_word1"     => $importData[3],

                                "answer2"       => $importData[4],
                                "arrange2"      => $importData[5],
                                "eng_word2"     => $importData[6],

                                "answer3"       => $importData[7],
                                "arrange3"      => $importData[8],
                                "eng_word3"     => $importData[9],

                                "answer4"       => $importData[10],
                                "arrange4"      => $importData[11],
                                "eng_word4"     => $importData[12],

                                "answer5"       => $importData[13],
                                "arrange5"      => $importData[14],
                                "eng_word5"     => $importData[15],

                                "answer6"       => $importData[16],
                                "arrange6"      => $importData[17],
                                "eng_word6"     => $importData[18],

                                "answer7"       => $importData[19],
                                "arrange7"      => $importData[20],
                                "eng_word7"     => $importData[21],

                                "answer8"       => $importData[22],
                                "arrange8"      => $importData[23],
                                "eng_word8"     => $importData[24],

                                "level"         => $importData[25],
                                "hint"          => $importData[26],
                            );
                            // var_dump($insertData['answer1']); 
                            /*  */
                            if($insertData['question']){
                                $fill_Q = new UnwQues();
                                $fill_Q->question = $insertData['question'];
                                if($request->format_title){
                                    $fill_Q->format_title = $request->format_title;
                                }
                                if(!empty($insertData['level'])){
                                    if($insertData['level'] == 'easy'){
                                        $fill_Q->difficulty_level_id = 1;
                                    }else if($insertData['level'] == 'medium'){
                                        $fill_Q->difficulty_level_id = 2;
                                    }else if($insertData['level'] == 'hard'){
                                        $fill_Q->difficulty_level_id = 3;
                                    }
                                }
                                if ($insertData['hint'] == '-') {
                                }else{
                                    $fill_Q->hint = $insertData['hint'];
                                }
                                $fill_Q->save();
                                if($request->problem_set_id && $request->format_type_id){
                                    $pbq = new ProblemSetQues();
                                    $pbq->problem_set_id = $request->problem_set_id;
                                    $pbq->question_id = $fill_Q->id;
                                    $pbq->format_type_id = $request->format_type_id;
                                    $pbq->save();
                                }
                                

                                for ($x = 1; $x <= 8; $x++) {
                                    $f_answer  = $insertData['answer'.$x];
                                    $f_arrange  = $insertData['arrange'.$x];
                                    $f_eng_word  = $insertData['eng_word'.$x];
                                    
                                    if ($f_answer == '-') {
                                    } else {
                                        $f_Ans1 = new UnwAns();
                                        $f_Ans1->question_id = $fill_Q->id;
                                        $f_Ans1->answer = $f_answer;
                                        $f_Ans1->arrange = $f_arrange;
                                        if ($f_eng_word == '-') {
                                        } else {
                                            $f_Ans1->eng_word = $f_eng_word;
                                        }
                                        $f_Ans1->save();
                                    }
                                }
                                /* if($insertData['answer1'] == '-'){
                                }else{
                                    $f_Ans1 = new UnwAns();
                                    $f_Ans1->question_id = $fill_Q->id;
                                    $f_Ans1->answer = $insertData['answer1'];
                                    $f_Ans1->arrange = $insertData['arrange1'];
                                    $f_Ans1->save();
                                }
                                if($insertData['answer2'] == '-'){
                                }else{
                                    $f_Ans2 = new UnwAns();
                                    $f_Ans2->question_id = $fill_Q->id;
                                    $f_Ans2->answer = $insertData['answer2'];
                                    $f_Ans2->arrange = $insertData['arrange2'];
                                    $f_Ans2->save();
                                }
                                if($insertData['answer3'] == '-'){
                                }else{
                                    $f_Ans3 = new UnwAns();
                                    $f_Ans3->question_id = $fill_Q->id;
                                    $f_Ans3->answer = $insertData['answer3'];
                                    $f_Ans3->arrange = $insertData['arrange3'];
                                    $f_Ans3->save();
                                }
                                if($insertData['answer4'] == '-'){
                                }else{
                                    $f_Ans4 = new UnwAns();
                                    $f_Ans4->question_id = $fill_Q->id;
                                    $f_Ans4->answer = $insertData['answer4'];
                                    $f_Ans4->arrange = $insertData['arrange4'];
                                    $f_Ans4->save();
                                }
                                if($insertData['answer5'] == '-'){
                                }else{
                                    $f_Ans5 = new UnwAns();
                                    $f_Ans5->question_id = $fill_Q->id;
                                    $f_Ans5->answer = $insertData['answer5'];
                                    $f_Ans5->arrange = $insertData['arrange5'];
                                    $f_Ans5->save();
                                }
                                if($insertData['answer6'] == '-'){
                                }else{
                                    $f_Ans6 = new UnwAns();
                                    $f_Ans6->question_id = $fill_Q->id;
                                    $f_Ans6->answer = $insertData['answer6'];
                                    $f_Ans6->arrange = $insertData['arrange6'];
                                    $f_Ans6->save();
                                }
                                if($insertData['answer7'] == '-'){
                                }else{
                                    $f_Ans7 = new UnwAns();
                                    $f_Ans7->question_id = $fill_Q->id;
                                    $f_Ans7->answer = $insertData['answer7'];
                                    $f_Ans7->arrange = $insertData['arrange7'];
                                    $f_Ans7->save();
                                }
                                if($insertData['answer8'] == '-'){
                                }else{
                                    $f_Ans8 = new UnwAns();
                                    $f_Ans8->question_id = $fill_Q->id;
                                    $f_Ans8->answer = $insertData['answer8'];
                                    $f_Ans8->arrange = $insertData['arrange8'];
                                    $f_Ans8->save();
                                } */
                                
                            }
                            /*  */
                        }
                    // Session::flash('message', 'Import Successful.');
                } else {
                    // Session::flash('message', 'File too large. File must be less than 2MB.');
                }
            } else {
                // Session::flash('message', 'Invalid File Extension.');
            }
        return back();
    }
    public function inactive($id){
        $f = UnwQues::where('id', $id)->first();
        $f->active = '0';
        $f->save();
        return back();
    }
    public function active($id){
        $f = UnwQues::where('id', $id)->first();
        $f->active = '1';
        $f->save();
        return back();
    }
}
