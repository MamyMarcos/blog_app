<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $tags
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="articles form content">
            <?= $this->Form->create($article) ?>
            <fieldset>
                <legend><?= __('Ajouter un article') ?></legend>
                <?php
                echo $this->Form->control('title',[
                    'label'=>'Titre'
                ]);
                echo $this->Form->control('content',[
                    'label'=>'Contenu'
                ]);
                echo $this->Form->control('tags._ids', [
                    'label' => 'Vous pouvez associer à votre article un ou plusieurs tags :',
                    'type' => 'select',
                    'multiple' => 'checkbox',
                    'options' => $lesTags
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Soumettre')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
