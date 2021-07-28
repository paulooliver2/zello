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
                            <a class="nav-link" aria-current="page" href="/">Pessoa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/apps">Apps</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="container">
            <div class="bg-light p-5 rounded">
                <h1>Cadastro de aplicativos </h1>
                <form id="formApps">
                    <input type="hidden"  name="id"  id="apps_id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="apps_name"
                               name="name" maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label for="bundle_id" class="form-label">Bundle</label>
                        <input type="text" class="form-control" id="apps_bundle_id"
                               name="bundle_id" maxlength="50"
                               >
                    </div>


                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                <p class="lead"></p>
                <table class="table table-bordered">
                    <thread>
                        <tr>
                            <td>Nome</td>
                            <td>Bundle</td>
                            <td>Ação</td>
                        </tr>
                    </thread>
                    <tbody id="tr_apps">

                    </tbody>
                </table>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function () {

                function listApps() {
                    $('#tr_apps').empty();
                    $.get('/api/apps', function (response) {
                        $.each(response, function (c, e) {
                            var tr = '<tr><td>' + e.name + '</td><td>' +
                                    e.bundle_id + '</td>' +
                                    '<td><a href="javascript:;" class="appsEdit" id="appsedit_' +
                                    e.id + '">Editar</a> | ' +
                                    '<a href="javascript:;" class="appsDel" id="appsdel_' +
                                    e.id + '">Excluir<a></td></tr>';
                            $('#tr_apps').append(tr);
                        });

                    });
                }

                listApps();
                $("#formApps").submit(function (e) {
                    e.preventDefault();
                    if (!!$('#apps_id').val()) {
                        $.ajax({
                            url: '/api/apps/' + $('#apps_id').val(),
                            type: 'PUT',
                            data: $('#formApps').serialize(),
                            success: function (response) {
                                alert('Aplicativo alterado com sucesso');
                                $('#formApps')[0].reset();
                                listApps();
                            }
                        });
                        return;
                    }

                    $.post('/api/apps', $("#formApps").serialize(), function (response) {
                        $('#formApps')[0].reset();
                        alert('Aplicativo cadastrado com sucesso');
                        listApps();
                    });
                });

                $(document).on('click', '.appsEdit', function (e) {
                    $.get('api/apps/' + $(e.target).attr('id').split("_")[1], function (response) {
                        $('#apps_id').val(response.id);
                        $('#apps_name').val(response.name);
                        $('#apps_bundle_id').val(response.bundle_id);
                    });
                });

                $(document).on('click', '.appsDel', function (e) {
                    $.ajax({
                        url: '/api/apps/' + $(e.target).attr('id').split("_")[1],
                        type: 'DELETE',
                        success: function (response) {
                            alert('Aplicativo excluido com sucesso');
                            listApps();
                        }
                    });
                });
            });


        </script>
    </body>
</html>