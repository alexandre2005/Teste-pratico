@extends('adminlte::page')
@php
    use App\User;
@endphp
@section('content')

    <div class="container mt-5">

        
    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Veiculos

                        </h4>
                    </div>
                    <div class="card-body">
                        {{-- Slider Data --}}

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Placa</th>
                                    <th>Renavam</th>
                                    <th>Modelo</th>
                                    <th>Marca</th>
                                    <th>Ano</th>
                                    <th>Propietario</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($veiculos as $auto)

                                    <tr>
                                        <td> {{$auto->id}} </td>
                                        <td> {{$auto->placa}} </td>
                                        <td> {{$auto->renavam}} </td>
                                        <td> {{$auto->modelo}} </td>
                                        <td> {{$auto->marca}} </td>
                                        <td> {{$auto->ano}} </td>
                                        <td> {{$auto->propietario}} </td>
                                        <td>
                                            @if(auth()->user()->role == User::ROLE_ADMIN)
                                                <a href="{{ url('edit-veiculo/'.$auto->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                <form action="{{ url('delete-veiculo/'.$auto->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                        
                                    </tr>

                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
