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
                                <li class="breadcrumb-item"><a href="{{ route('users') }}">Utilisateurs</a></li>
                                <li class="breadcrumb-item active">Edition</li>
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
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Modifier un utilisateur</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" action="{{route('users.update')}}" accept-charset="UTF-8">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Prénom</label>
                                            <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nom</label>
                                            <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Mot de passe</label>
                                            <input type="password" class="form-control" name="password" value="">
                                        </div>
                                        <select name="role" class="form-control">
                                            <option value="{{ $user->role_id }}">{{ $user->role->name_of }}</option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->role_id }}">{{ $role->name_of }}</option>
                                            @endforeach
                                        </select>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" {{ $user->is_active ? 'checked' : '' }} class="custom-control-input" data-id="{{ $user->id }}" id="slider{{ $user->id }}" />
                                            <label class="custom-control-label" for="slider{{ $user->id }}">Activer l'utilisateur</label>
                                        </div>
                                    </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                            </form>
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