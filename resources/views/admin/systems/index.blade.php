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
    <div class="table-responsive">
        <table class="table border mb-0">
            <thead class="table-light fw-semibold">
                <tr class="align-middle">
                    <th>Systems</th>
                    <th>Errors Count</th>
                </tr>
            </thead>
            <tbody>
                @forelse($systems as $system)
                    <tr class="align-middle">
                        <td>
                            <div><a
                                    href="{{ route('errors.index', ['project' => $system->project_id, 'system' => $system->id]) }}">{{ $system->dbName }}</a>
                            </div>
                        </td>
                        <td>
                            @if ($system->errorsCount())
                                <button type="button"
                                    class="btn btn-primary rounded-pill">{{ $system->errorsCount() }}</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <p>No System</p>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
