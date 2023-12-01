<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 * @var \Cake\Collection\CollectionInterface|string[] $articles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tags'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tags form content">
            <?= $this->Form->create($tag) ?>
            <fieldset>
                <legend><?= __('Ajouter un Tag') ?></legend>
                <?php
                echo $this->Form->control('title', [
                    'label' => 'Titre'
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Soumettre')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
