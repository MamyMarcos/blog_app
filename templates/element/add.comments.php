<h4>Ajouter un commentaire</h4>
<?php
echo $this->Form->create($leNewComment);
echo $this->Form->control('title', ['label' => 'Le titre du commentaire']);
echo $this->Form->control('content',
        ['rows' => '3',
            'label' => 'Le contenu du commentaire']);
echo $this->Form->button(__("Sauvegarder le commentaire"));
echo $this->Form->end();
?>



