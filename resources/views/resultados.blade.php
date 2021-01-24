@extends('layouts.master')

@section('title', $title)

@section('content')

    <div class="row mt-5">

        <div class="col-md-5 mx-auto">

            <table class="table">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha_desde</th>
                    <th scope="col">Fecha_hasta</th>
                </thead>
                <tbody>
                    @foreach ($result as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->min}}</td>
                            <td>{{$item->max}}</td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection