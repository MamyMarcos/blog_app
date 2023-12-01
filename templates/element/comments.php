<div class="related mb-4">
    <h4><?= __('Commentaires') ?></h4>
    <?php if (!empty($article->comments)) : ?>
        <div class="table-responsive">
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Titre') ?></th>
                    <th><?= __('Contenu') ?></th>
                    <th><?= __('Date de création') ?></th>
                    <th><?= __('Auteur') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($article->comments as $comments) : ?>
                    <tr>
                        <td><?= h($comments->id) ?></td>
                        <td><?= h($comments->title) ?></td>
                        <td><?= h($comments->content) ?></td>
                        <td><?= h($comments->created) ?></td>
                        <td><?= h($comments->user->username) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
</div>

