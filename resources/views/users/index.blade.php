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
                            <h1 class="m-0">Utilisateurs</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('chat') }}">Accueil</a></li>
                                <li class="breadcrumb-item active">Utilisateurs</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if(session()->has('ok')) <!-- Ceci est une condition qui vérifie si une variable de session nommée "ok" existe. -->
                    <div class="alert alert-success alert-dismissible">
                        {!! session('ok') !!}
                    </div>
                    @endif
                    <!-- Main row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header row align-items-center">
                                    <div class="col-6">
                                        <h3 class="card-title">Liste des utilisateurs</h3>
                                    </div>

                                    <div class="col-3">
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="table_search" class="form-control" placeholder="Search">


                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <a class="btn btn-success" href="{{ route('users.create') }}" role="button"><i class="fa-solid fa-plus align-middle"></i> Ajouter un
                                            utilisateur</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Prénom</th>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Rôle</th>
                                                <th>Actif ?</th>
                                                <th>Modifier</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->firstname }}</td>
                                                <td>{{ $user->lastname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role->name_of }}</td>
                                                <td>

                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" {{ $user->is_active ? 'checked' : '' }} class="custom-control-input" data-id="{{ $user->id }}" id="slider{{ $user->id }}" />
                                                        <label class="custom-control-label" for="slider{{ $user->id }}"></label>
                                                    </div>
                                                </td>
                                                <td><a class="btn btn-primary" href="{{ route('users.edit', ['id' => $user->id]) }}" role="button"><i class="fa-solid fa-pen align-middle"></i></a>
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
    @push('scripts')
    <script type="text/javascript">
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const inputs = document.querySelectorAll("input[type=checkbox]");

        inputs.forEach(input => {

            $(input).on('change', function(e) {
                let id = $(this).attr("data-id");
                let url = "";

                if (e.target.checked) {
                    url = "{{ route('users.active', ':id') }}";
                } else {
                    url = "{{ route('users.delete', ':id') }}";
                }

                url = url.replace(':id', id);
                $.ajax({
                    type: 'POST',
                    url: url,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    data: {
                        id: id,
                        _token: CSRF_TOKEN,
                        message: $(".getinfo").val()
                    },
                    success: function(result) {

                    }
                });
            });
        });
    </script>
    @endpush
</x-app-layout>