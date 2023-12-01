<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Nationality[]|\Cake\Collection\CollectionInterface $nationalities
 */
?>
<div class="nationalities index content">
    <?= $this->Html->link(__('New Nationality'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Nationalities') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('mmodified') ?></th>
                    <th><?= $this->Paginator->sort('nombre utilisateur') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nationalities as $nationality): ?>
                <tr>
                    <td><?= $this->Number->format($nationality->id) ?></td>
                    <td><?= h($nationality->name) ?></td>
                    <td><?= h($nationality->created) ?></td>
                    <td><?= h($nationality->mmodified) ?></td>
                    <td><?= h($nationality->count->users) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $nationality->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $nationality->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $nationality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nationality->id)]) ?>
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
