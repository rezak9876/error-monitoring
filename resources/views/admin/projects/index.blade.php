@extends('admin.layouts.app')

@section('body')
    @if (Session::has('message'))
        <div class="toast-container position-absolute p-3 top-0 end-0" id="toastPlacement"
            data-original-class="toast-container position-absolute p-3">
            <div class="toast fade show">
                <div class="toast-header">
                    <svg class="bd-placeholder-img rounded me-2" width="20" height="20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice"
                        focusable="false">
                        <rect width="100%" height="100%" fill="green"></rect>
                    </svg>
                </div>
                <div class="toast-body">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    @endif
    <div class="mb-3">
        <a class="btn btn-primary" href="{{ route('projects.create') }}">create</a>
    </div>
    @if ($projects->isNotEmpty())
        <div class="table-responsive">
            <table class="table border mb-0">
                <thead class="table-light fw-semibold">
                    <tr class="align-middle">
                        <th>Projecs</th>
                        <th>Errors Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr class="align-middle">
                            <td>
                                <div><a href="{{ route('projects.show', $project->id) }}">
                                        {{ $project->title }}</a></div>
                            </td>
                            <td>
                                @if ($project->errorsCount())
                                    <a href="{{ route('systems.index', ['filter_project_id' => $project->id]) }}">

                                        <button type="button" class="btn btn-primary rounded-pill">



                                            {{ $project->errorsCount() }}

                                        </button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No Project</p>
    @endif
@endsection
