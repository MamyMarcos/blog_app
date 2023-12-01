<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterUsersAddFknationalies extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $tableUsers = $this->table('users');
        $tableUsers->addColumn('nationality_id', 'integer');
        $tableUsers->update();

        //je rajoute la contrainte dans la clé étrangère
        $tableUsers = $this->table('users');
        $tableUsers->addForeignKey('nationality_id', 'nationalities', 'id');
        $tableUsers->update();
    }

}
