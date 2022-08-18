<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\RepError;
use App\Models\System;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project,System $system)
    {
        $errors = $system->errors()->selectRaw('count(*) as count')->groupBy('id')->orderBy('id','DESC')->paginate(2);
        return view('admin.errors.index', compact('errors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(String $token,Request $request)
    {
        $project = Project::where('token', $token)->first();

        $systemValues = $this->getArrayByPrefix('systems_', $request->all());

        $system = System::where($systemValues)->first();

        if (is_null($system))
            $system = $project->systems()->create($systemValues);

        $error_array = [
            'Message' => $request->input('errorMessage'),
            'Code' => $request->input('errorCode'),
            'File' => $request->input('errorFile'),
            'Line' => $request->input('errorLine'),
            'Trace' => $request->input('errorTrace'),
        ];


        $repError = RepError::where($error_array)->first();

        if (is_null($repError))
            $repError = RepError::create($error_array);


        // $projectError = $project->errors->first();

        // if (is_null($projectError))
        //     $project->errors()->syncWithPivotValues(
        //         $repError->id,
        //         ['count' => 1]
        //     );
        // else {
        //     $count = $projectError->pivot->count;
        //     $project->errors()->updateExistingPivot(
        //         $repError->id,
        //         ['count' => $count + 1]
        //     );
        // }

        $system->errors()->attach(
            $repError->id
        );





        dd($error_array);
    }


    protected function getArrayByPrefix(String $prefix, array $array)
    {
        $systemInformations = array_filter($array, function ($key) use ($prefix) {
            return (substr($key, 0, strlen($prefix)) === $prefix);
        }, ARRAY_FILTER_USE_KEY);


        return array_combine(
            array_map(function ($k)  use ($prefix) {
                return substr($k, strlen($prefix));
            }, array_keys($systemInformations)),
            $systemInformations
        );
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RepError $error)
    {
        $result = [
            "id" => $error->id,
            "message" => $error->message,
            "code" => $error->code,
            "file" => $error->file,
            "line" => $error->line,
            "trace" => json_decode($error->trace),
            "created_at" => $error->created_at->format('Y-m-d H:i:s'),
            "updated_at" => $error->updated_at->format('Y-m-d H:i:s')
        ];
        dd($result  );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
