<?php


use Phinx\Seed\AbstractSeed;

class UnitsSeeder extends AbstractSeed
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
                'unit_name' => 'Unidade Blumenau',
            ],
            [
                'unit_name' => 'Unidade Rio de Janeiro',
            ],
            [
                'unit_name' => 'Unidade Navegantes',
            ],
            [
                'unit_name' => 'Unidade Itajaí',
            ],
        ];

        $units = $this->table('units');
        $units->insert($data)
            ->save();
    }
}
