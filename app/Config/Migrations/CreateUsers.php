<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string', [
            'default' => null,
            'limit' => 40,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'null' => false,
            'limit' => 40,
        ]);
        $table->addColumn('full_name', 'string', [
            'default' => null,
            'null' => false,
            'limit' => 80,
        ]);
        $table->addColumn('role', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => '2020-01-28 20:20:20',
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => '2020-01-28 20:20:20',
            'null' => false,
        ]);
        $table->create();
    }
}