<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateArticlesTags extends AbstractMigration
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
        $table = $this->table('articles_tags', [
            'id' => false, 
            'primary_key' => ['article_id', 'tag_id']
        ]);
        $table->addColumn('article_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('tag_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('priority', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('article_id', 'articles', 'id');
        $table->addForeignKey('tag_id', 'tags', 'id');
        $table->create();
    }
}
