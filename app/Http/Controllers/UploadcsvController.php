<?php


namespace App\Http\Controllers;
use App\Upload;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Quizmaterial;


class UploadcsvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function upload(Request $request){

        if ($request->hasFile('csv')) {

            Upload::truncate();
        
            //get file
            $upload = $request->file('csv');
            // dd($upload);
            $filePath = $upload->getRealPath();
            //open and read
            $file = fopen($filePath, 'r');
    
            $header = fgetcsv($file);
    
            $escapedHeader = [];
            //validate
            foreach ($header as $key => $value) {
                $lheader = strtolower($value);
                // $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
                // dd($escapedItem);
                array_push($escapedHeader, $lheader);
            }

             //looping through othe columns
            while ($columns = fgetcsv($file)) {
                // dd($columns);
                if ($columns[0] == "") {
                    continue;
                }
            //trim data
                // foreach ($columns as $key => &$value) {
                //     $value = preg_replace('/\D/', '', $value);

                   
                // }
                
                $data = array_combine($escapedHeader, $columns);
                // dd($data);


           
           // Table update
                $type = $data['type'];
                $question = $data['question'];
                $option1 = $data['option1'];
                $option2 = $data['option2'];
                $option3 = $data['option3'];
                $option4 = $data['option4'];
                $answer = $data['answer'];

                $upload = new Upload();
                $upload->type = $type;
                $upload->question = $question;
                $upload->option1 = $option1;
                $upload->option2 = $option2;
                $upload->option3 = $option3;
                $upload->option4 = $option4;
                $upload->answer = $answer;
                $upload->save();
            }

            return response()->json(['data' => 'Data uploaded Successfully'], Response::HTTP_CREATED);

        }else {
            return response()->json(['error' => 'You must upload a csv file'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }  



    }

    public function uploadMaterial(Request $request){

        if ($request->hasFile('study_guide')) {

            Quizmaterial::truncate();
        
            //get file
            $upload = $request->file('study_guide');
            // dd($upload);
            $filePath = $upload->getRealPath();
            //open and read
            $file = fopen($filePath, 'r');

            $header = fgetcsv($file);

            $escapedHeader = [];
            //validate
            foreach ($header as $key => $value) {
                $lheader = strtolower($value);
                // $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
                // dd($escapedItem);
                array_push($escapedHeader, $lheader);
            }

                // dd($escapedHeader);
             //looping through othe columns
            while ($columns = fgetcsv($file)) {
                // dd($columns);
                if ($columns[0] == "") {
                    continue;
                }
           

                $data = array_combine($escapedHeader, $columns);
                // dd($data);

           // Table update
                $type = $data['type'];
                $image = $data['image'];
                $locations = $data['locations'];
                $size = $data['size'];
                $lifespan = $data['lifespan'];
                $diet = $data['diet'];
                $description = utf8_encode($data['description']);

                $upload = new Quizmaterial();
                $upload->type = $type;
                $upload->image = $image;
                $upload->locations = $locations;
                $upload->size = $size;
                $upload->lifespan = $lifespan;
                $upload->diet = $diet;
                $upload->description = $description;
                $upload->save();
            }

            return response()->json(['data' => 'Data uploaded Successfully'], Response::HTTP_CREATED);

        } else {
            return response()->json(['error' => 'You must upload a csv file'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }  



        
    }
}
