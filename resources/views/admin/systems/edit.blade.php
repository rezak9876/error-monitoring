@extends('admin.layouts.app')

@section('body')
    <form action="{{ route('systems.update',$system->id) }}" method="post">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="title" value="{{$system->title}}">
        </div>
        
        <div class="mb-3">
            <label for="dbName" class="form-label">dbName</label>
            <input name="dbName" type="text" class="form-control" id="dbName" placeholder="dbName" value="{{$system->dbName}}">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
