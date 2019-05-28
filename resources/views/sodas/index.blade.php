@extends('layouts.app')

@section('content')

{{--
<div class="row">
    <div class="col-md-10 offset-md-1">
         @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
        @endif
        <a class="btn btn-success" href="{{ route('sodas.create')}}">
            Adicionar refrigerante
        </a>
        <br /><br />
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Marca</td>
                    <td>Litragem</td>
                    <td>Tipo</td>
                    <td>Quantidade</td>
                    <td>Preço por unidade</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($sodas as $soda)
                    <tr>
                        <td>{{$soda->brand}}</td>
                        <td>{{$soda->liters}}</td>
                        <td>{{$soda->type}}</td>
                        <td>{{$soda->quantity}}</td>
                        <td>{{$soda->pricePerUnit}}</td>
                        <td>
                            <a href="{{ route('sodas.edit',$soda->id)}}"
                            class="btn btn-primary">
                            E
                            </a>
                            <form action="{{ route('sodas.destroy', $soda->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">X</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Gerenciar Refrigerantes</div>
                    <div class="card-body">
                        <router-view name="sodasIndex"></router-view>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
