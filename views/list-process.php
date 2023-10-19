<?php $v->layout("_main"); ?>

<div class="process-list row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Lista de Processos
                    <a href="<?= url("new"); ?>" class="btn btn-success float-end">Novo Processo</a>
                </h4>
            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped" id=process-table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Pessoa</th>
                            <th>Unidade</th>
                            <th>Status</th>
                            <th>Data Criação</th>
                            <th>Data Modificação</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($list):
                            foreach($list as $item):
                            ?>
                                <tr>
                                    <td><?= $item['codigo']; ?></td>
                                    <td><?= $item['nome']; ?></td>
                                    <td><?= $item['pessoa']; ?></td>
                                    <td><?= $item['unidade']; ?></td>
                                    <td><?= $item['status']; ?></td>
                                    <td><?= $item['criacao']; ?></td>
                                    <td><?= $item['edicao']; ?></td>
                                    <td>
                                        <a href="<?= url("edit/{$item['codigo']}"); ?>" class="btn btn-primary">Editar</a>
                                        <button class="btn btn-danger delete-button" data-codigo="<?= $item['codigo'] ?>">Deletar</button>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                        endif; 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $v->start("scripts"); ?>
<script>
    $(document).ready(function() {
        $('.delete-button').click(function() {
            let codigo = $(this).data('codigo');
            
            if (confirm("Tem certeza de que deseja excluir este processo?")) {
                $.ajax({
                    url: 'delete/' + codigo,
                    method: 'DELETE',
                    success: function(data) {
                        location.reload();
                    },
                    error: function() {
                        alert("Erro ao deletar processo")
                    }
                });
            }
        });
    });
</script>
<?php $v->end(); ?>
</html>