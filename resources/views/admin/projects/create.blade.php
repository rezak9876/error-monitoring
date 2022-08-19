@extends('admin.layouts.app')

@section('body')
    <form action="{{ route('projects.store') }}" method="post">
        @csrf
        {{-- <div class="mb-3">
            <label for="language" class="form-label">Language</label>
            <select name="language" class="form-select" id="language" aria-label="language">
                <option value="php" selected>php</option>
                <option value="javascript">javascript</option>
            </select>
        </div> --}}
        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="title">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
