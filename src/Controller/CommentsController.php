<?php

namespace App\Controller;

class CommentsController extends AppController {

    public function add() {
        $leNewComment = $this->Comments->newEmptyEntity();
        //pour charger le model comments
        $this->loadModel('Articles'); 
        $lesArticles = $this->Articles->find('list', [
                'keyField' => 'id',
                'valueField' => 'title'
            ]);
         //Pour récupérer les artiles
            $lesArticles = $lesArticles->toArray();//pour mettre dans un tableau
        if ($this->request->is('post')) {
            $leNewComment = $this->Comments->patchEntity($leNewComment, $this->request->getData());
            if ($this->Comments->save($leNewComment)) {
                $this->Flash->success(__("Le commentaire a été sauvegardé."));
                return $this->redirect(['controller' => 'articles', 'action' => 'index']);
            } else {
                $this->Flash->error(__("Impossible d'ajouter votre commentaire."));
            }
        }
        $this->set(compact('leNewComment', 'lesArticles')); //sert à envoyer la vue q'on veut avoir
    }
   /**
    * Edit comment
    * 
    * @param string $id
    * @return void
    */ 
        public function edit($id = null) {
        try {
            $comment = $this->Comments->get($id);
        } catch (\Exception $ex) {
            if ($id == null) {
                $this->Flash->error(__("Le commentaire edit doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("Le commentaire {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Comments->patchEntity($comment, $this->request->getdata());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('Votre commentaire a été mis à jour.'));
                return $this->redirect(['controller' => 'Articles','action' => 'view', $comment->article_id]);
            } else
                $this->Flash->error(__('Impossible de mettre à jour votre commentaire.'));
        }
        $this->set(compact('comment'));
    }
    public function delete($id = null) {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $leComment = $this->Comments->get($id);
            if ($this->Comments->delete($leComment)) {
                $this->Flash->success(__("L'article {0} d' id {1} a bien été supprimé ! ", $leComment->title, $leComment->id));
            return $this->redirect(['controller'=> 'articles','action' => 'view', $leComment->article_id]);
                
            }
        } catch (\Exception $ex) {
            $this->Flash->error(__("Vous ne pouvez pas faire cette action"));
            return $this->redirect(['controller'=> 'articles','action' => 'view', $leComment->article_id]);
        }
    }

}
