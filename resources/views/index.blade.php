<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Zello</title>
    </head>
    <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Zello</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Pessoa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/apps">Apps</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <main class="container">
            <div class="bg-light p-5 rounded">
                <h1>Cadastro de pessoas </h1>
                <form id="formPerson">
                    <input type="hidden"  name="id"  id="person_id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="person_name"
                               name="name" maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label for="birthdate" class="form-label">Data de nascimento</label>
                        <input type="text" class="form-control" id="person_birthdate"
                               name="birthdate" maxlength="10"
                               placeholder="00/00/0000"
                               >
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">Cpf</label>
                        <input type="text"
                               placeholder="000.000.000-00"
                               maxlength="11" class="form-control" id="person_cpf"
                               name="cpf">
                    </div>
                    <div class="mb-3">
                        <label for="rg" class="form-label">Rg</label>
                        <input type="text" class="form-control" id="person_rg"
                               name="rg" maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="profile" class="form-label">Perfil</label>
                        <select class="form-select" name="profile"
                                id="person_profile" aria-label="Default select example">
                            <option selected>Selecione o perfil</option>
                            <option value="1">Usuario comun</option>
                            <option value="2">Gestor</option>
                            <option value="3">Administrador</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                <p class="lead"></p>
                <table class="table table-bordered">
                    <thread>
                        <tr>
                            <td>Nome</td>
                            <td>Data nascimento</td>
                            <td>Cpf</td>
                            <td>Rg</td>
                            <td>Perfil</td>
                            <td>Ação</td>
                        </tr>
                    </thread>
                    <tbody id="tr_person">

                    </tbody>
                </table>
            </div>
            <div class="bg-light p-5 rounded">
                <h1>Vincular aplicativo</h1>
                <form id="formPersonApps">
                    <div class="mb-3">
                        <label for="person" class="form-label">Pessoa</label>
                        <select class="form-select" name="person_id"
                                id="select_person" aria-label="Default select example">
                        </select>
                        <label for="apps" class="form-label">Aplicativo</label>
                        <select class="form-select" name="apps_id"
                                id="select_apps" aria-label="Default select example">
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Vincular</button>
                </form>
                <p class="lead"></p>
                <table class="table table-bordered">
                    <thread>
                        <tr>
                            <td>Pessoa</td>
                            <td>Aplicativo</td>
                            <td>Ação</td>
                        </tr>
                    </thread>
                    <tbody id="tr_person_apps">

                    </tbody>
                </table>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function () {
                var profiles = {
                    1: "Usuario comum",
                    2: "Gestor",
                    3: "Administrador"
                };

                function listPerson() {
                    $('#tr_person').empty();
                    $.get('/api/person', function (response) {
                        $.each(response, function (c, e) {
                            var tr = '<tr><td>' + e.name + '</td><td>' +
                                    e.birthdate + '</td><td>' +
                                    e.cpf + '</td><td>' +
                                    e.rg + '</td><td>' +
                                    profiles[e.profile] + '</td>' +
                                    '<td><a href="javascript:;" class="personEdit" id="personedit_' +
                                    e.id + '">Editar</a> | ' +
                                    '<a href="javascript:;" class="personDel" id="persondel_' +
                                    e.id + '">Excluir<a></td></tr>';
                            $('#tr_person').append(tr);
                            var options = '<option value="' + e.id + '">' + e.name + '</option>';
                            $('#select_person').append(options);
                        });
                    });
                }

                listPerson();

                $("#formPerson").submit(function (e) {
                    e.preventDefault();

                    if (!!$('#person_id').val()) {
                        $.ajax({
                            url: '/api/person/' + $('#person_id').val(),
                            type: 'PUT',
                            data: $('#formPerson').serialize(),
                            success: function (response) {
                                alert('Pessoa alterada com sucesso');
                                $('#formPerson')[0].reset();
                                listPerson();
                            }
                        });
                        return;
                    }

                    $.post('/api/person', $("#formPerson").serialize(), function (response) {
                        $('#formPerson')[0].reset();
                        alert('Pessoa cadastrada com sucesso');
                        listPerson();
                    });
                });

                $(document).on('click', '.personEdit', function (e) {
                    $.get('api/person/' + $(e.target).attr('id').split("_")[1], function (response) {
                        $('#person_id').val(response.id);
                        $('#person_name').val(response.name);
                        $('#person_birthdate').val(response.birthdate);
                        $('#person_cpf').val(response.cpf);
                        $('#person_rg').val(response.rg);
                        $('#person_profile').val(response.profile);
                    });
                });

                $(document).on('click', '.personDel', function (e) {
                    $.ajax({
                        url: '/api/person/' + $(e.target).attr('id').split("_")[1],
                        type: 'DELETE',
                        success: function (response) {
                            alert('Pessoa excluida com sucesso');
                            listPerson();
                        }
                    });
                });

                function listApps() {
                    $('#select_apps').empty();
                    $.get('/api/apps', function (response) {
                        $.each(response, function (c, e) {
                            var options = '<option value="' + e.id + '">' + e.name + '</option>';
                            $('#select_apps').append(options);
                        });
                    });
                }

                function listPersonApps(personId) {
                    $('#tr_person_apps').empty();
                    $.get('/api/person/' + personId + '/apps', function (response) {
                        $.each(response, function (c, e) {
                            var tr = '<tr><td>' + e.person_id + '</td><td>' +
                                    e.apps_id + '</td><td>' +
                                    '<a href="javascript:;" class="personAppsDel" id="personappsdel_' +
                                    e.person_id + '_' + e.id + '">Excluir<a></td></tr>';
                            $('#tr_person_apps').append(tr);

                        });
                    });
                }

                listApps();

                $("#formPersonApps").submit(function (e) {
                    e.preventDefault();
                    $.post('/api/person/' + $('select[name=person_id] option:selected').val() + '/apps',
                            $("#formPersonApps").serialize(), function (response) {
                        alert('Vinculo feito com sucesso');
                        listPersonApps($('select[name=person_id] option:selected').val());
                    });
                });


                $(document).on('click', '.personAppsDel', function (e) {
                    $.ajax({
                        url: '/api/person/' + $(e.target).attr('id').split("_")[1] + '/apps/' + $(e.target).attr('id').split("_")[2],
                        type: 'DELETE',
                        success: function (response) {
                            alert('Vinculo excluido com sucesso');
                            listPersonApps($(e.target).attr('id').split("_")[1]);
                        }
                    });
                });




            });



        </script>
    </body>
</html>