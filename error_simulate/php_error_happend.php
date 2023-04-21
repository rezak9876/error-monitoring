<?php

use Illuminate\Support\Facades\DB;

//calcute base path of project
$basePath = dirname(__DIR__, 1);

//error listener
set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($basePath) {

    try {
        //just work in fullsana
        if ($_SERVER['APP_URL'] === 'http://domain.test') {
            // $serverValues = $_SERVER;

            // $serverValues = array_combine(
            //     array_map(function($k){ return 'Server_'.$k; }, array_keys($serverValues)),
            //     $serverValues
            // );


            //system informations array
            $systems = [
                'systems_domain' => $_SERVER['APP_URL'],
                'systems_dbName' => DB::connection()->getPdo()->query('select database()')->fetchColumn(),
            ];


            // calcute trace according to base path
            $trace = debug_backtrace();
            foreach ($trace as $key => $t) {
                $trace[$key]['file'] = str_replace($basePath, "basePath", $t['file']);
                foreach ($trace[$key]['args'] as $argkey => $arg) {
                    if (gettype($arg) === 'string')
                        $trace[$key]['args'][$argkey] = str_replace($basePath, "basePath", $arg);
                }
            }


            //error information array
            $error_array = [
                'errorlanguage' => 'php',
                'errorMessage' => $errstr,
                'errorCode' => $errno,
                'errorFile' => str_replace($basePath, "basePath", $errfile),
                'errorLine' => $errline,
                'errorTrace' => json_encode($trace)
            ];

            //request body param
            $postFields = array_merge($error_array/*,$serverValues*/, $systems);

            //send information as http request 


            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_URL, "http://error-monitoring.pzhame.ir/api/a2918bf3b6d6867d96385add0a8cc5042f35a4e6/errors");

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


            curl_setopt($ch, CURLOPT_POST, true);

            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                $postFields
            );
            // $output contains the output string
            $output = curl_exec($ch);

            // close curl resource to free up system resources
            curl_close($ch);
            echo $output;
        }
    } catch (Error $e) {
    }
});

echo $hihp;
echo $g;
echo $h;
echo $h;
echo $h;
echo $h;
echo $h;
echo $h;
// echo $h;
// echo $h;
// echo $h;
// echo $h;
// echo $h;
// echo $h;
// echo $h;
