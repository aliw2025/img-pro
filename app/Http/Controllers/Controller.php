<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\Process\Process;
use Illuminate\Http\Request;
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
            throw new ProcessFailedException($process);
        }

        $process = new Process(['py','new.py']);
        
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }


        dump(json_decode($process->getOutput(), true));

    }

    public function perfromCal(Request $request){
       

        // dd($request->all());
        $b = "ls";
        // $s = "py ".$path;
        // $s ="dir";
        $process1 = new Process(['.\env\Scripts\activate']);
        
        $process1->run();
        if (!$process1->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $process = new Process(['py','new.py',$request->file_name]);
        
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }


        // dump(json_decode($process->getOutput(), true));

        return $process->getOutput();
    }
    
}
