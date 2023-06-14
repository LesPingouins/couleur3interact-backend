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
                                    <h3 class="card-title">Créer un utilisateur</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" action="{{route('users.store')}}" accept-charset="UTF-8">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group {!! $errors->has('username') ? 'has-error' : '' !!}">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input type="text" class="form-control" name="username" value="" placeholder="Entrez votre username">
                                            {!! $errors->first('username', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group{!! $errors->has('firstname') ? 'has-error' : '' !!}">
                                            <label for="exampleInputEmail1">Prénom</label>
                                            <input type="text" class="form-control" name="firstname" value="" placeholder="Entrez votre prénom">
                                            {!! $errors->first('firstname', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group{!! $errors->has('lastname') ? 'has-error' : '' !!}">
                                            <label for="exampleInputEmail1">Nom</label>
                                            <input type="text" class="form-control" name="lastname" value="" placeholder="Entrez votre nom">
                                            {!! $errors->first('lastname', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group{!! $errors->has('email') ? 'has-error' : '' !!}">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" name="email" value="" placeholder="Entrez votre email">
                                            {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <div class="form-group{!! $errors->has('password') ? 'has-error' : '' !!}">
                                            <label for="exampleInputPassword1">Mot de passe</label>
                                            <input type="password" class="form-control" name="password" value="" placeholder="Entrez votre mot de passe">
                                            {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
                                        </div>
                                        <select name="role" class="form-control">
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name_of }}</option>
                                            @endforeach
                                        </select>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" {{ old('is_active') ? 'checked' : '' }} class="custom-control-input" id="is_active" name="is_active">
                                            <label class="custom-control-label" for="is_active">Activer l'utilisateur</label>
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