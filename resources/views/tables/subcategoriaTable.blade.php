@extends('layouts.user_type.auth')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Tabla de subcategorias</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 text-center">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">
                                                Creada por
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Categoría padre
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Código
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nombre
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Descripción
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Creada
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Editar
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Eliminar
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($subcategorias as $subcategoria)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="../assets/img/team-2.jpg"
                                                                class="avatar avatar-sm me-3" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $subcategoria->subcategoria_creada_por }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $subcategoria->id }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $subcategoria->categoria->nombre_categoria }}</p>
                                                </td>
                                                <td class="text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $subcategoria->codigo_subcategoria }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $subcategoria->nombre_subcategoria }}</span>
                                                </td>

                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $subcategoria->descripcion_subcategoria }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $subcategoria->created_at->format('d/m/Y') }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('editar-subcategoria-update', $subcategoria->id) }}"
                                                        class="btn bg-gradient-info">Editar</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('eliminar-subcategoria', $subcategoria->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn bg-gradient-danger"
                                                            onclick="return confirm('¿Estás seguro de eliminar esta subcategoría?')">Eliminar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">No se encontraron subcategorías</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    {{-- Alerta de éxito --}}
                    @if (session('mensaje'))
                        <div class="alert alert-success" role="alert">
                            <strong>Success!</strong> {{ session('mensaje') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
