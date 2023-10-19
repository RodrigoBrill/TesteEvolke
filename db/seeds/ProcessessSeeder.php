<?php


use Phinx\Seed\AbstractSeed;

class ProcessessSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [
            [
                'process_name' => 'Certificados em lote',
                'person_id' => 1,
                'unit_id' => 1,
                'status_id' => 1,
            ],
            [
                'process_name' => 'Importação de pessoas',
                'person_id' => 2,
                'unit_id' => 2,
                'status_id' => 2,
            ],
            [
                'process_name' => 'Importação de cargos',
                'person_id' => 3,
                'unit_id' => 3,
                'status_id' => 3,
            ],
            [
                'process_name' => 'Importação de setores',
                'person_id' => 4,
                'unit_id' => 4,
                'status_id' => 1,
            ],
        ];

        $processess = $this->table('processess');
        $processess->insert($data)
            ->save();
    }
}
