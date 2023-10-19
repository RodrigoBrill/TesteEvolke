<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Processess extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $processos = $this->table('processess');
        $processos->addColumn('process_name', 'text')
            ->addColumn('person_id', 'integer')
            ->addColumn('unit_id', 'integer')
            ->addColumn('status_id', 'integer')
            ->addColumn('id_fila', 'integer')
            ->addTimestamps()
            ->create();
    }
}
