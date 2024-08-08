@extends('layout.layout')
@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Inventario</h2>
        <p class="card-text">En esta pantalla solo se podran observar lo que se tiene de inventario </p>
        <hr>

        <div class="table-responsive m-t-40">
            <table id="dtInventario" class="table table-striped table-bordered table-condensed table-hover text-left" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $pro)
                    <tr>
                        <td>{{$pro->nombre}}</td>
                        <td>{{$pro->precio}}</td>
                        <td class="text-center">{{ $pro->cantidad }}</td>
                    </td>
                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
