@extends('layout.layout')
@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Historial de movimiento</h2>
        <hr>

        <div class="table-responsive m-t-40">
            <table id="dtHistorial" class="table table-striped table-bordered table-condensed table-hover text-left" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Movimiento</th>
                        <th>Fecha Movimiento</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($historiales as $his)
                    <tr>
                        <td>{{$his->nombre}}</td>
                        <td>{{$his->cantidad}}</td>
                        <td> @if ($his->movimiento==1)
                            ENTRADA
                        @else
                            SALIDA
                        @endif
                        </td>
                        <td>{{$his->fechaMov}}</td>
                        <td>@if ($his->estatus=1)
                            ACTIVO
                            @else
                            INACTIVO
                            @endif

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
