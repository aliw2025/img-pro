<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\Process\Process;
use Illuminate\Http\Request;
use App\Models\File;

use Symfony\Component\Process\Exception\ProcessFailedException;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function cal(){
       
        $b = "ls";
        // $s = "py ".$path;
        // $s ="dir";
        $process1 = new Process(['.\env\Scripts\activate']);
        $process1->run();
        if (!$process1->isSuccessful()) {
            throw new ProcessFailedException($process1);
        }

        $process = new Process(['py','new.py']);
        
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        dump(json_decode($process->getOutput(), true));

    }
    public function home(){

        $file = File::all()->first();
        return view('home',compact('file'));
    }

    public function upload(Request $request){
       

            $request->validate([
                'file_name' => 'required'
            ]);
           

        // dd($request->all());
        $fileModel = new File();
        // dd($request->all());
        // dd();
        File::truncate();
      
        if($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            // dd($file);s
            $fileName = $file->getClientOriginalName();
            $filePath = $request->file('file_name')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = $file->getClientOriginalName();
            $fileModel->file_path = url('/').'/public/storage/' . $filePath;
            $fileModel->save();
            return redirect()->route('home')->with('success','File has been uploaded.');
           
        }
    }
    
    public function perfromCal(Request $request){
            
        $b = "ls";
        // $s = "py ".$path;
        // $s ="dir";
        $process1 = new Process(['.\env\Scripts\activate']);
        
        $process1->run();
        if (!$process1->isSuccessful()) {
            throw new ProcessFailedException($process1);
        }
        // dd($request->file_name);
        $process = new Process(['py','new.py',$request->file_name]);
        
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }


        // dump(json_decode($process->getOutput(), true));
         $output =  $process->getOutput();
         $file = File::first();
         $result = url('/').'/public/storage/uploads/result.png';
         return  view('home',compact('result','file','output'));
        
    }
    
}
