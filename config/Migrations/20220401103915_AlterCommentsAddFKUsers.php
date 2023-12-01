<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterCommentsAddFKUsers extends AbstractMigration
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
        //je récupère la table à modifier
        $tableComments = $this->table('comments');
        $tableComments->addColumn('user_id', 'integer');
        $tableComments->update();
        
        $this->execute('UPDATE comments SET user_id = (select id from users limit 1)');
                
        //je rajoute la contrainte dans la clé étrangère
         $tableComments = $this->table('comments');
         $tableComments->addForeignKey('user_id', 'users', 'id');
           $tableComments->update();
    }
}
