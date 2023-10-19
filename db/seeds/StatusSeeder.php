<?php


use Phinx\Seed\AbstractSeed;

class StatusSeeder extends AbstractSeed
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
                'status_name' => 'EM_ANDAMENTO',
            ],
            [
                'status_name' => 'PROCESSADO',
            ],
            [
                'status_name' => 'CANCELADO',
            ],
        ];

        $status = $this->table('status');
        $status->insert($data)
            ->save();
    }
}
