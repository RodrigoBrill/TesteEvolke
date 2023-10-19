<?php $v->layout("_main"); ?>

<div class="process-list row">
    <div class="col-md-12">
        <div class="card">
            <form id="edit-form" action="update" method="PUT">
                <div class="card-header">
                    <h4>Editar Processo
                    <button id="integrar-volklms" style="display: none;" class="btn btn-success float-end">Integrar com VolkLMS</button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="form-group m-3">
                        <label for="nome">Nome do Processo:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $process->process_name ?>" disabled>
                    </div>

                    <div class="form-group m-3">
                        <label for="pessoa">Pessoa:</label>
                        <select class="form-control" id="pessoa" name="pessoa" disabled>
                            <option value="">Selecione a pessoa...</option>
                            <?php 
                            if ($person_list):
                                foreach($person_list as $item):
                                ?>
                                    <option value="<?= $item->id; ?>" <?php if ($item->id == $process->person_id) echo 'selected'; ?>><?= $item->person_name; ?></option>
                                <?php
                                endforeach;
                            endif; 
                            ?>
                        </select>
                    </div>

                    <div class="form-group m-3">
                        <label for="unidade">Unidade:</label>
                        <select class="form-control" id="unidade" name="unidade" disabled>
                            <option value="">Selecione a unidade...</option>
                            <?php 
                            if ($unit_list):
                                foreach($unit_list as $item):
                                ?>
                                    <option value="<?= $item->id; ?>" <?php if ($item->id == $process->unit_id) echo 'selected'; ?>><?= $item->unit_name; ?></option>
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
                                    <option value="<?= $item->id; ?>" <?php if ($item->id == $process->status_id) echo 'selected'; ?>><?= $item->status_name; ?></option>
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
        $('#edit-form').on('submit', function(e) {
            e.preventDefault();

            let formData = {
                id: <?= $process->id ?>,
                nome: $('#nome').val(),
                pessoa: $('#pessoa').val(),
                unidade: $('#unidade').val(),
                status: $('#status').val()
            };

            $.ajax({
                url: $(this).attr('action'), 
                method: 'PUT',
                data: formData,
                success: function(data) {
                    $('#message').text('Processo editado com sucesso!');
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

            let formDataGet = {
                action: 'updateQueue',
                id_fila: <?= $process->id_fila ?> ?? 1,
                status: $('#status').val(),
            };

            $.ajax({
                url: url,
                method: 'GET',
                data: formDataAuth,
                dataType: 'json',
                success: function(data) {
                    let access_token = data.result.access_token;
                    $.ajax({
                        url: url,
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' . access_token
                        },
                        data: formDataNew,
                        success: function(data) {
                            $('#message').text("Integração realizada com sucesso!");
                        },
                        error: function() {
                            $('#message').text("Erro ao realizar integração");
                        }
                    });
                },
                error: function() {
                    alert("Erro ao realizar integração");
                }
            });
        });
    });
</script>
<?php $v->end(); ?>