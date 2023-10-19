<?php $v->layout("_main"); ?>

<div class="process-list row">
    <div class="col-md-12">
        <div class="card">
            <form id="process-form" action="create" method="POST">
                <div class="card-header">
                    <h4>Cadastrar Processo
                    <button id="integrar-volklms" style="display: none;" class="btn btn-success float-end">Integrar com VolkLMS</button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="form-group m-3">
                        <label for="nome">Nome do Processo:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do processo" required>
                    </div>

                    <div class="form-group m-3">
                        <label for="pessoa">Pessoa:</label>
                        <select class="form-control" id="pessoa" name="pessoa" required>
                            <option value="">Selecione a pessoa...</option>
                            <?php 
                            if ($person_list):
                                foreach($person_list as $item):
                                ?>
                                    <option value="<?= $item->id; ?>"><?= $item->person_name; ?></option>
                                <?php
                                endforeach;
                            endif; 
                            ?>
                        </select>
                    </div>

                    <div class="form-group m-3">
                        <label for="unidade">Unidade:</label>
                        <select class="form-control" id="unidade" name="unidade" required>
                            <option value="">Selecione a unidade...</option>
                            <?php 
                            if ($unit_list):
                                foreach($unit_list as $item):
                                ?>
                                    <option value="<?= $item->id; ?>"><?= $item->unit_name; ?></option>
                                <?php
                                endforeach;
                            endif; 
                            ?>
                        </select>
                    </div>

                    <div class="form-group m-3">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Selecione o status...</option>
                            <?php 
                            if ($status_list):
                                foreach($status_list as $item):
                                ?>
                                    <option value="<?= $item->id; ?>"><?= $item->status_name; ?></option>
                                <?php
                                endforeach;
                            endif; 
                            ?>
                        </select>
                    </div>

                    <div class="form-group m-1">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>

                    <div class="form-group m-3">
                        <h4 id="message"></h4>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $v->start("scripts"); ?>
<script>
    $(document).ready(function() {
        $('#process-form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'), 
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    $('#message').text('Processo cadastrado com sucesso!');
                    $('#integrar-volklms').show();
                }
            });
        });

        $('#integrar-volklms').click(function() {
            const url = 'https://dev.evolke.com.br/admin/gabriel/evolke-admin/api/v2/router.php';

            let formDataAuth = {
                action: 'authToken',
                email: 'volklms@evolke.com.br',
                senha: 'volklmsdesafio'
            };

            let formDataNew = {
                action: 'newQueue',
                id_pessoa: $('#pessoa').val(),
                id_unidade: $('#unidade').val(),
                status: $('#status').val(),
                acao_fila: 1
            };

            $.ajax({
                url: 'https://dev.evolke.com.br/admin/gabriel/evolke-admin/api/v2/router.php',
                method: 'GET',
                data: formDataAuth,
                dataType: 'json',
                success: function(data) {
                    let access_token = data.result.access_token;
                    $.ajax({
                        url: 'https://dev.evolke.com.br/admin/gabriel/evolke-admin/api/v2/router.php',
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' . access_token
                        },
                        data: formDataNew,
                        success: function(data) {
                            let queueExists = verifyQueue(access_token)
                            if (queueExists && data.error === "") {
                                //Aqui eu salvaria o retorno do id_fila no processo, porém o endpoint não está funcionando atualmente.
                            }
                            $('#message').text('Integração realizada com sucesso!');
                        },
                        error: function() {
                            $('#message').text("Erro ao realizar integração");
                        }
                    });
                },
                error: function() {
                    $('#message').text("Erro ao realizar integração");
                }
            });
        });

        function verifyQueue(access_token) {
            const url = 'https://dev.evolke.com.br/admin/gabriel/evolke-admin/api/v2/router.php';

            let formDataGet = {
                action: 'getQueue',
                if_fila: <?= $process->id_fila ?> ?? 1,
            };

            $.ajax({
                url: url,
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' . access_token
                },
                data: formDataNew,
                dataType: 'json',
                success: function(data) {
                    return data.error === "";
                },
                error: function() {
                    $('#message').text("Erro ao realizar integração");
                }
            });
        }
    });
</script>
<?php $v->end(); ?>