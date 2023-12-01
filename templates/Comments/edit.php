<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $comment
 * @var string[]|\Cake\Collection\CollectionInterface $articles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?=
            $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $comment->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'class' => 'side-nav-item']
            )
            ?>
<?= $this->Html->link(__('List Tags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tags form content">
                <?= $this->Form->create($comment) ?>
            <fieldset>
                <legend><?= __('Edit Comment') ?></legend>
                <?php
                echo $this->Form->control('title', ['label' => 'Le titre du commentaire']);
                echo $this->Form->control('content',
                        ['rows' => '3',
                            'label' => 'Le contenu du commentaire']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Soumettre')) ?>
<?= $this->Form->end() ?>
        </div>
    </div>
</div>
