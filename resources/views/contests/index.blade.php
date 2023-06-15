<x-app-layout bodyClass="g-sidenav-show  bg-gray-200">
    <!-- provide the csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="wrapper">
        <x-navbar />
        <x-sidebar />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Concours</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('chat') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">Concours</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header row align-items-center">
                                    <div class="col-9">
                                        <h3 class="card-title">Liste des concours</h3>
                                    </div>


                                    <div class="col-3">
                                        <a class="btn btn-success" href="#" role="button"><i
                                                class="fa-solid fa-plus align-middle"></i> Ajouter un
                                            concours</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Titre</th>
                                                <th>Question</th>
                                                <th>Durée</th>
                                                <th>Type</th>
                                                <th>Créateur</th>
                                                <th>Actif ?</th>
                                                <th>Modifier</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($events as $event)
                                                <tr>
                                                    <td>{{ $event->id }}</td>
                                                    <td>{{ $event->name_of }}</td>
                                                    <td>{{ $event->question }}</td>
                                                    <td>{{ $event->duration }}</td>
                                                    <td>Concours</td>
                                                    <td>{{ $event->user->username }}</td>
                                                    <td>

                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                {{ $event->is_active ? 'checked' : '' }}
                                                                class="custom-control-input"
                                                                data-id="{{ $event->id }}"
                                                                id="slider{{ $event->id }}" />
                                                            <label class="custom-control-label"
                                                                for="slider{{ $event->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td><a class="btn btn-primary"
                                                            href="#"
                                                            role="button"><i
                                                                class="fa-solid fa-pen align-middle"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <x-footer />
    </div>
    <!-- ./wrapper -->

</x-app-layout>
