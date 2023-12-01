<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Ajouter un utilisateur') ?></legend>
                <?php
                    echo $this->Form->control('name',[
                        'label'=>'Prénom'
                    ]);
                    echo $this->Form->control('lastname',[
                        'label'=>'Nom'
                    ]);
                    echo $this->Form->control('age');
                    echo $this->Form->control('email');
                    echo $this->Form->control('username',[
                        'label'=>'Nom utilisateur'
                    ]);
                    echo $this->Form->control('password',[
                        'label'=>'Mot de passe'
                    ]);
                    echo $this->Form->control('nationalities._ids', [
                    'label' => 'Vous pouvez choisir la nationalité :',
                    'type' => 'select',
                    'multiple' => 'checkbox',
                    'options' => $lesUsers
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Soumettre')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
