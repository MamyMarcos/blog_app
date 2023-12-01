<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $tags
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?=
            $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $article->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'side-nav-item']
            )
            ?>
<?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="articles form content">
                <?= $this->Form->create($article) ?>
            <fieldset>
                <legend><?= __('Modifier un article') ?></legend>
                <?php
                echo $this->Form->control('title',[
                    'label'=>'titre'
                ]);
                echo $this->Form->control('content',[
                    'label'=>'contenu'
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
