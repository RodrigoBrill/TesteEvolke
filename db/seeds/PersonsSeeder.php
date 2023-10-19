<?php


use Phinx\Seed\AbstractSeed;

class PersonsSeeder extends AbstractSeed
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
                'person_name' => 'Victor',
            ],
            [
                'person_name' => 'Gabriel',
            ],
            [
                'person_name' => 'Robson',
            ],
            [
                'person_name' => 'Anderson',
            ],
        ];

        $persons = $this->table('persons');
        $persons->insert($data)
            ->save();
    }
}
