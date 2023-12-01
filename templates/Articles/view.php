<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
$this->assign('script',  $this->Html->script('jquery360min'));
$this->assign('title',  __('Article n°{0}', $article->id));
?>
<div class="row mb-4">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Article'), ['action' => 'edit', $article->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Article'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Article'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="articles view content">
            <h3><?= h($article->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Titre') ?></th>
                    <td><?= h($article->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Utilisateur') ?></th>
                    <td><?= $article->has('user') ? $this->Html->link($article->user->username, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($article->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date de création') ?></th>
                    <td><?= h($article->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date de modification') ?></th>
                    <td><?= h($article->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Contenu') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($article->content)); ?>
                </blockquote>
            </div>
            <div class="related mb-4">
                <h4><?= __('Tags associés') ?></h4>
                <?php if (!empty($article->tags)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Titre') ?></th>
                                <th><?= __('Date de création') ?></th>
                                <th><?= __('Date de modification') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($article->tags as $tags) : ?>
                                <tr>
                                    <td><?= h($tags->id) ?></td>
                                    <td><?= h($tags->title) ?></td>
                                    <td><?= h($tags->created) ?></td>
                                    <td><?= h($tags->modified) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <?=
            $this->Form->button(__('Ajouter un commentaire'), [
                'id' => 'btn-add-comment',
                'type' => 'button',
            ])
            ?>
            <?=
            $this->Form->button(__('Afficher les commentaires'), [
                'id' => 'btn-view-comments',
                'type'=>'button',
            ])
            ?>
            <div id="showcomment" style="display:none;">
<?= $this->element('comments') ?>
            </div>
            <div id="addcomment" style="display:none;">
<?= $this->element('add.comments') ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#btn-add-comment").click(function () {
            if ($("#addcomment").is(":visible") == false)
            {
                $("#addcomment").show();
                $(this).text("Ne pas ajouter un commentaire");
            } else {
                $("#addcomment").hide();
                $(this).text("Ajouter un commentaire");
            }
        });

        $("#btn-view-comments").click(function () {
            if ($("#showcomment").is(":visible") == false)
            {
                $("#showcomment").show();
                $(this).text("Ne pas afficher les commentaire");
            } else {
                $("#showcomment").hide();
                $(this).text("Afficher les commentaire");
            }
        });
    });
</script>