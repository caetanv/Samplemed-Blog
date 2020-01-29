<?php
use Migrations\AbstractMigration;

class CreateTopics extends AbstractMigration
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
        $table = $this->table('topics');
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'null' => false,
            'limit' => 80,
        ]);
        $table->addColumn('visible', 'boolean', [
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