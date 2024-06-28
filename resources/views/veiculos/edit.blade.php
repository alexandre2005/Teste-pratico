@extends('adminlte::page')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <h5 class="alert alert-success">{{session('status')}}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4> Edit Veiculo
                            <a href="{{ url('home-veiculo') }}" class="btn btn-danger btn-sm float-right">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        {{-- Slider Data --}}

                        <form action="{{ url('update-veiculo/'.$veiculo->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="">Placa</label>
                                <input type="text" name="placa" class="form-control" value="{{ old('placa', $veiculo->placa) }}">
                            </div>

                            <div class="form-group">
                                <label for="">Renavam</label>
                                <input type="text" name="renavam" class="form-control" value="{{ old('renavam', $veiculo->renavam) }}">
                            </div>

                            <div class="form-group">
                                <label for="">Modelo</label>
                                <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $veiculo->modelo) }}">
                            </div>

                            <div class="form-group">
                                <label for="">Marca</label>
                                <input type="text" name="marca" class="form-control" value="{{ old('marca', $veiculo->marca) }}">
                            </div>

                            <div class="form-group">
                                <label for="">Ano</label>
                                <input type="number" name="ano" class="form-control" id="ano" min="1900" max="2100" step="1" value="{{ old('ano', $veiculo->ano) }}">
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                   <label for="">Propietario</label>
                                   <select class="form-control" name="propietario">
                                    <option value=""></option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $veiculo->propietario ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
