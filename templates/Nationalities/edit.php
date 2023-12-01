<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Nationality $nationality
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $nationality->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $nationality->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Nationalities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="nationalities form content">
            <?= $this->Form->create($nationality) ?>
            <fieldset>
                <legend><?= __('Edit Nationality') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('mmodified');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
