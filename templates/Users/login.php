<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Entrez votre nom utilisateur et mot de passe') ?></legend>
        <?= $this->Form->control('username',[
            'label'=>'Nom utilisateur'
        ]) ?>
       <?= $this->Form->control('password', [
           'type'=>'password',
           'label'=>'Mot de passe'
           ]) ?>
    </fieldset>
    <?= $this->Form->button(__('Connexion')); ?>
    <?= $this->Form->end() ?>
</div>
