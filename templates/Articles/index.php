<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="articles index content">
    <?= $this->Html->link(__('Ajouter un Article'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Articles') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('titre') ?></th>
                    <th><?= $this->Paginator->sort('Date de création') ?></th>
                    <th><?= $this->Paginator->sort('Date de modication') ?></th>
                    <th><?= $this->Paginator->sort('Créer par') ?></th>
                    <th><?= $this->Paginator->sort('Commentaires') ?></th>
                    <th><?= $this->Paginator->sort('Tags') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $this->Number->format($article->id) ?></td>
                        <td>
                            <?=
                            $this->html->link($article->title, [
                                'controller' => 'articles',
                                'action' => 'view',
                                $article->id]);
//l’url généré sera de la forme /posts/view/1 ou /posts/view/25…
                            ?>
                        </td>                
                        <td><?= h($article->created) ?></td>
                        <td><?= h($article->modified) ?></td>
                        <td><?=
                            $article->has('user') ? $this->Html->link($article->user->username, [
                                        'controller' => 'Users',
                                        'action' => 'view',
                                        $article->user->id]) : ''
                            ?></td>
                        <td><?= count($article->comments) ?></td>
                        <td><?= count($article->tags) ?></td>

                        <td class="actions">

                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), [
                                'action' => 'delete',
                                $article->id],
                                    [
                                        'confirm' => __('Are you sure you want to delete # {0}?',
                                                $article->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
