@extends('layouts.app')

@section('content')

<div class="card-header">
    Editar Refrigerante
</div>
<div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br />
    @endif

    <form method="post" action="{{ route('sodas.update', $soda->id) }}">
    @method('PATCH')
    @csrf
        <div class="form-group">
            <label for="brand">Marca:</label>
            <input type="text" class="form-control" name="brand" value={{ $soda->brand }} />
        </div>
        <div class="form-group">
            <label for="liters">Litragem :</label>
            {{-- <input type="text" class="form-control" name="liters" value={{ $soda->liters }} /> --}}
            <select name="liters" class="form-control" required>
                    <option value="">--</option>
                    <option value="250ml">250ml</option>
                    <option value="600ml">600ml</option>
                    <option value="1l">1l</option>
                    <option value="1.5l">1.5l</option>
                    <option value="2l">2l</option>
                    <option value="3l">3l</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            {{-- <input type="text" class="form-control" name="tipo" value={{ $soda->type }} /> --}}
            <select name="type" class="form-control" required>
                    <option value="">--</option>
                    <option value="Pet">Pet</option>
                    <option value="Garrafa">Garrafa</option>
                    <option value="Lata">Lata</option>
            </select>
        </div>
        <div class="form-group">
                <label for="quantity">Quantidade:</label>
                <input type="number" class="form-control" name="quantity" value={{ $soda->quantity }} />
            </div>
        <div class="form-group">
            <label for="pricePerUnit">Preço por unidade:</label>
            <input type="text" class="form-control" name="pricePerUnit" value={{ $soda->pricePerUnit }} />
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
