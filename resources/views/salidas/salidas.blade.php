@extends('layout.layout')
@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Salida de productos</h2>
        <hr>

        <div class="table-responsive m-t-40">
            <table id="dtInventario" class="table table-striped table-bordered table-condensed table-hover text-left" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th class="text-center"><i class="mdi mdi-table-column-plus-after"></i> Salida</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $pro)
                    <tr>
                        <td>{{$pro->nombre}}</td>
                        <td>{{$pro->precio}}</td>
                        <td class="text-center">{{ $pro->cantidad }}</td>
                    <td class="text-center">
                    <button class="btn btn-secondary " type="button"
                        onclick="abrirModalSalida(<?= $pro->idProducto ?>,<?= $pro->cantidad ?>)">
                       Salida</button></td>
                    </td>
                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalSalida" tabindex="-1" role="dialog" aria-labelledby="modalSalidaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalSalidaLabel">New message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                @csrf
            <div class="form-group">
                <input type="text" class="form-control" id="txtIdProducto" hidden>
            </div>
            <div class="form-group">
                <label for="txtCantidadActual" class="col-form-label">Cantidad Actual:</label>
                <input type="number" class="form-control" readonly id="txtCantidadActual">
            </div>
            <div class="form-group">
                <label for="txtCantidad" class="col-form-label">Cantidad a dar salida:</label>
                <input type="number" class="form-control" id="txtCantidad">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="restarInventarioProducto()">Guardar</button>
        </div>
        </div>
    </div>
</div>
@endsection
