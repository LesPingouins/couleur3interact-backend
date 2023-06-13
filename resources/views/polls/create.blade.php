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
                            <h1 class="m-0">Sondages</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('chat') }}">Accueil</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('polls.index') }}">Sondages</a></li>
                                <li class="breadcrumb-item active">Ajout</li>
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
                                    <h3 class="card-title">Créer un sondage</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" action="{{ route('polls.store') }}">
                                    {{ csrf_field() }}
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="name_of">Nom*</label>
                                                <input class="form-control" name="name_of" id="name_of"
                                                    placeholder="Entrez un nom...">
                                                @if ($errors->has('name_of'))
                                                    <span class="text-danger">{{ $errors->first('name_of') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="description">Description</label>
                                                <input class="form-control" name="description" id="description"
                                                    placeholder="Entrez une description..." />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="question">Question*</label>
                                                <input class="form-control" name="question" id="question"
                                                    placeholder="Entrez une question..." />
                                                @if ($errors->has('question'))
                                                    <span class="text-danger">{{ $errors->first('question') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label for="duration">Durée du sondage (en secondes)*</label>
                                                <input class="form-control" name="duration" id="duration"
                                                    placeholder="Entrez une durée (en secondes)...">
                                                @if ($errors->has('duration'))
                                                    <span class="text-danger">{{ $errors->first('duration') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row pl-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="is_predefined"
                                                    id="switch">
                                                <label class="custom-control-label" for="switch">Réponse libre
                                                    ?</label>
                                            </div>
                                        </div>
                                        <div id="divPredefined" class="mt-3">
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="addChoice">Choix multiples</label>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input class="form-control" id="addChoice"
                                                                placeholder="Ajoutez un choix..." />
                                                        </div>
                                                        <div class="col-4">
                                                            <button class="btn btn-primary" id="btnAddChoice"><i
                                                                    class="fa-solid fa-plus align-middle"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="rowChoices" class="row">

                                            </div>

                                            <template id="templateChoice">
                                                <div id="containerChoice" class="row col-6">
                                                    <div class="col-10 mt-1">
                                                        <input class="form-control " name="choices[]" id="choice"
                                                            value="" />
                                                    </div>
                                                    <div class="col-2 mt-1">
                                                        <button class="btn btn-danger" data-index="" id="btnChoice">
                                                            <i class="fa-solid fa-minus align-middle"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Envoyer le sondage</button>
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
    @push('scripts')
        <script type="text/javascript">
            const btnChoice = document.querySelector("#btnAddChoice");
            const inputChoice = document.querySelector("#addChoice");
            const template = document.querySelector('#templateChoice');
            const rowChoices = document.querySelector('#rowChoices');
            const inputSwitch = document.querySelector('#switch');
            const divPredefined = document.querySelector("#divPredefined");

            let idButton = 1;
            let isSwitchON = false;

            inputSwitch.addEventListener("change", function(e) {
                divPredefined.classList.toggle("d-none");
                isSwitchON = !isSwitchON;
            })


            btnChoice.addEventListener("click", function(e) {
                e.preventDefault();
                const clone = template.content.cloneNode(true);
                const inputTemplate = clone.querySelector(".form-control");
                const btnTemplate = clone.querySelector("button");
                const containerTemplate = clone.querySelector("#containerChoice");

                if (inputChoice.value.trim() !== "") {
                    containerTemplate.id = "containerChoice" + idButton;
                    inputTemplate.id = "choice" + idButton;
                    btnTemplate.id = "btn" + idButton;
                    btnTemplate.dataset.index = idButton;

                    btnTemplate.addEventListener("click", function(e) {
                        e.preventDefault();
                        document.querySelector("#containerChoice" + btnTemplate.dataset.index).remove();
                    });

                    inputTemplate.value = inputChoice.value.trim();
                    rowChoices.appendChild(clone);
                    idButton++;
                }
            })
        </script>
    @endpush
</x-app-layout>
