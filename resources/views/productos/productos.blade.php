@extends('layout.layout')
@section('contenido')

<div class="card">
    <div class="card-body">
        <h2 class="card-title">Productos</h2>
        <p class="card-text">En esta pantalla podrás gestionar los productos </p>
        <hr>
        <button
            type="button"
            class="btn btn-outline-primary" data-toggle="modal" data-target="#modalAgregar"><i class="mdi mdi-plus"></i>
            Agregar
        </button>

        <div class="table-responsive m-t-40">
            <table id="dtProductos" class="table table-striped table-bordered table-condensed table-hover text-left" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        {{-- <th>Cantidad Inventario</th> --}}
                        <th>Estatus</th>
                        <th class="text-center"><i class="mdi mdi-table-column-plus-after"></i> Aumentar</th>
                        <th class="text-center"><i class="mdi mdi-delete"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $pro)
                    <tr>
                        <td>{{$pro->nombre}}</td>
                        <td>{{$pro->precio}}</td>
                        <td>{{ $pro->cantidad }}</td>
                        <td> @if ($pro->estatus==1)
                            ACTIVO
                        @else
                            INACTIVO
                        @endif
                    </td>
                    <td class="text-center">
                    @if ($pro->estatus==1)
                    <button class="btn btn-secondary " type="button"
                        onclick="abrirModalAumentar(<?= $pro->idProducto ?>,<?= $pro->cantidad ?>)">
                       Aumentar</button></td>
                    @else

                    @endif
                    </td>

                        <form action="" method="POST">
                            @csrf
                                    @if ($pro->estatus==1)
                                    <td class="text-center"><button class="btn btn-danger waves-effect btn-circle waves-light" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar" onclick="eliminarProductos(<?= $pro->idProducto ?>)">
                                        <i class="fa fa-trash"></i></button></td>
                                    @else
                                    <td class="text-center"><button class="btn btn-success waves-effect btn-circle waves-light" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar"
                                            onclick="activarProductos(<?= $pro->idProducto ?>)">
                                            <i class="fa fa-check-circle"></i></button></td>
                                    @endif


                        </form>
                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalAgregarLabel">Agregar Producto</h1>
          <a type="button" class="btn-close"  aria-label="Close"><i class="mdi mdi-close" data-dismiss="modal"></i>
          </a>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label for="txtNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="txtNombre">
              </div>
              <div class="mb-3">
                <label for="txtPrecio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="txtPrecio">
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiarModalAgregar()" aria-hidden="true">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="guardarProductos()">Agregar</button>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="modalAumentar" tabindex="-1" role="dialog" aria-labelledby="modalAumentarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalAumentarLabel">New message</h5>
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
                <label for="txtCantidad" class="col-form-label">Cantidad a Aumentar:</label>
                <input type="number" class="form-control" id="txtCantidad">
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="aumentarInventarioProducto()">Guardar</button>
        </div>
        </div>
    </div>
</div>
@endsection
