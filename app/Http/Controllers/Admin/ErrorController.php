<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\RepError;
use App\Models\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $errors = RepError::selectRaw('errors.* , count(errors.id) as errorsCount')
            ->join('error_system', 'errors.id', '=', 'error_system.error_id')
            ->join('systems', 'systems.id', '=', 'error_system.system_id')
            ->join('projects', 'projects.id', '=', 'systems.project_id')
            ->where('projects.user_id', Auth::id())
            ->groupBy('errors.id');

        if ($system_id = request()->query('filter_system_id')) {
            $errors->where('systems.id', $system_id);
            unset($_GET['filter_system_id']);
        }

        // foreach ($_GET as $key => $get) {
        //     if (substr($key, 0, strlen('filter_')) === 'filter_') {
        //         $property = str_replace('filter_', '', $key);
        //         $errors->where($property, $get);
        //     }
        // }


        $queryParams = array_reverse($_GET);
        foreach ($queryParams as $key => $queryParam) {
            if (substr($key, 0, strlen('sort_')) === 'sort_') {
                $key = str_replace('sort_', '', $key);
                $errors = $errors->orderBy($key, $queryParam);
            }
        }




        $errors = $errors->orderBy('errors.id', 'DESC');



        $errors = $errors->paginate(10);


        $sort_errorsCount = request()->query('sort_errorsCount');
        $sort_language = request()->query('sort_language');
        switch ($sort_errorsCount) {
            case 'asc':
                $nextsort_errorsCount = 'desc';
                break;
            case 'desc':
                $nextsort_errorsCount = 'asc';
                break;
            default:
                $nextsort_errorsCount = 'desc';
                break;
        }

        switch ($sort_language) {
            case 'asc':
                $nextsort_language = 'desc';
                break;
            case 'desc':
                $nextsort_language = 'asc';
                break;
            default:
                $nextsort_language = 'desc';
                break;
        }

        $sort = [
            'errorCount' => $nextsort_errorsCount,
            'sort_language' => $nextsort_language,
        ];
        return view('admin.errors.index', compact('errors', 'sort'));
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
    public function store(String $token, Request $request)
    {
        $project = Project::where('token', $token)->first();

        if (is_null($project))
            return 'token_is_invalid';


        $systemValues = $this->getArrayByPrefix('systems_', $request->all());

        $system = $project->systems()->where('domain', $systemValues['domain'])->first();

        if (is_null($system))
            $system = $project->systems()->create($systemValues);

        switch ($request->input('errorlanguage')) {
            case 'javascript':
                $trace = json_encode($request->input('errorTrace'));
                break;
            case 'php':
                $trace = $request->input('errorTrace');
        }

        $error_array = [
            'Language' => $request->input('errorlanguage'),
            'Message' => $request->input('errorMessage'),
            'Code' => $request->input('errorCode'),
            'File' => $request->input('errorFile'),
            'Line' => $request->input('errorLine'),
            'Trace' => $trace,
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




        return true;

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
        switch ($error->language) {
            case 'javascript':
                $trace = str_replace('\/', '/', $error->trace);
                $trace = explode('\n', $trace);
                break;
            case 'php':
                $trace = json_decode($error->trace);
        }
        $result = [
            "id" => $error->id,
            "message" => $error->message,
            "code" => $error->code,
            "file" => $error->file,
            "line" => $error->line,
            "trace" => $trace,
            "created_at" => $error->created_at->format('Y-m-d H:i:s'),
            "updated_at" => $error->updated_at->format('Y-m-d H:i:s')
        ];
        dd($result);
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
    public function destroy(RepError $error)
    {
        $error->delete();
        return redirect()->back()->with('message', 'error deleted!');;
    }
    public function groupDelete(Request $request)
    {
        $errors_id = $request->input('data')['errors_id'];
        DB::table("errors")->whereIn('id', $errors_id)->delete();
        Session::flash('message', 'errors deleted!');
    }
}
