@extends('layouts.master')

@section('title', $title)

@section('content')

    <div class="row mt-5">

        <div class="col-md-5 mx-auto">

            <table class="table">
                <thead>
                    <th scope="col">Registros duplicados</th>
                    <th scope="col">Numero de veces duplicado</th>
                </thead>
                <tbody>
                    @foreach ($result as $item)
                        <tr>
                            <th scope="row">{{$item->csvs}}</th>
                            <td>{{$item->count}}</td>
                        </tr>                        
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection