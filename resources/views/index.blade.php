
@extends('layouts.master')

@section('title', 'Subir csv')

@section('content')

    <div class="row">

        <div class="col-md-5 mx-auto">

            <form action="{{route('uploadCsv')}}" method="post" enctype="multipart/form-data">
                <h1 class="text-center">Subir csv</h1>
                @csrf

                @include('partials._errors')

                <div class="form-group">
                    <label for="formFile" class="form-label">Fichero csv</label>
                    <input class="form-control" type="file" name="file" id="formFile">
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                    subir csv
                </button>
    
            </form>

        </div>

    </div>

@endsection