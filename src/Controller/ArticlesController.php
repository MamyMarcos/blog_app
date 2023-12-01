<?php

namespace App\Controller;

class ArticlesController extends AppController {

    public function index() {

        $this->paginate = [
            'contain' => [
                'Users' => function ($q) {
                    return $q
                            ->select(['username', 'email', 'id']);
                },
                'Comments' => function ($q) {
                    return $q
                            ->select(['article_id']);
                },
                'Tags' => function ($q) {
                    return $q
                            ->select(['id']);
                }]
        ];

        //On  récupére  tous  les  articles  et  on  les  stocke  dans $articles
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));  //Envoie  à  la  vue  le contenu de $articles dans $rep qui sera utiliseable
    }

    public function view($id = null) {
        try {
            $article = $this->Articles->get($id, [
                'contain' => [
                    'Comments.Users' => function ($q) {
                        return $q
                                ->select(['username'])
                                ->order(['Comments.created asc']);
                    },
                    'Users' => function ($q) {
                        return $q
                                ->select(['username']);
                    },
                    'Tags' => function ($q) {
                        return $q
                                ->select(['title']);
                    }]]);

            $this->loadModel('Comments');
            $leNewComment = $this->Comments->newEmptyEntity();

            //on sauvegarde le commentaire 
            if ($this->request->is('post')) {
                $leNewComment = $this->Comments->patchEntity($leNewComment, $this->request->getData());
                $leNewComment->article_id = $article->id;
                $leNewComment->user_id = $this->Auth->user('id');
                if ($this->Comments->save($leNewComment)) {
                    $this->Flash->success(__("Le commentaire a été sauvegardé."));
                    return $this->redirect(['controller' => 'articles', 'action' => 'view', $article->id]);
                } else {
                    $this->Flash->error(__("Impossible d'ajouter votre commentaire."));
                }
            }
        } catch (\Exception $e) {
            if ($id == null) {
                $this->Flash->error(__("L'action detail doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L'article {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('article', 'leNewComment'));
    }

    public function add() {
        $article = $this->Articles->newEmptyEntity();

        //on récupere tous les tags à afficher
        $this->loadModel('Tags');
        $lesTags = $this->Tags->find('list', [
            'valueField' => ['title']
        ]);
        $lesTags = $lesTags->toArray();

        //on charche la table association pour sauvegarder à l'interieur
        $this->loadModel('ArticlesTags');

        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
        // pourque c'est l'auteur qui a créé seulement peut supprimer
            $article->user_id = $this->Auth->user('id');
            if ($this->Articles->save($article)) {
                //si on a associé des tags au articles :
                if ($this->request->getData('tags._ids') != null) {
                    //on recupere chaque id du tag
                    foreach ($this->request->getData('tags._ids') as $unTag_id) {
                        //on crée l'enregistrement
                        $leNewTag = $this->ArticlesTags->newEmptyEntity();
                        //on associe au article le tag
                        $leNewTag->article_id = $article->id;
                        $leNewTag->tag_id = $unTag_id;
                        $leNewTag->priority = 5;
                        //on enregistre dans la BDD
                        $this->ArticlesTags->save($leNewTag);
                    }
                }
                $this->Flash->success(__("Le article a été sauvegardé."));
                return $this->redirect(['action' => 'index']);
            } else
                $this->Flash->error(__("Impossible d'ajouter votre article."));
        }
        $this->set(compact('article', 'lesTags'));
        //$this->set(compact('leNewArticle'));
    }

    public function edit($id = null) {
        try {
            $article = $this->Articles->get($id, [
                'contain' => [
                    'Tags'
                ]
            ]);
            //$this->loadModel('Users'); //tp3: c'est pour appeler un autre model, ici par exemple c'est l'user qu'on veut récupérer
            // Dans un controller ou dans une méthode de table.
            $this->loadModel('Tags');
//            $lesUsers = $this->Users->find('list', [
//                'keyField' => 'id',
//                'valueField' => 'username'
//            ]);
//            $lesUsers = $lesUsers->toArray();

            $lesTags = $this->Tags->find('list', [
                'keyField' => 'id',
                'valueField' => 'title'
            ]);
            $lesTags = $lesTags->toArray();
        } catch (\Exception $e) {
            if ($id == null) {
                $this->Flash->error(__("L'action detail doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L'article {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }
//on peur supprimer que l'article créer par l'user connecté
        if ($article->user_id != $this->Auth->user('id')) {
            $this->Flash->error(__('vous ne pouvez pas faire cette modification.'));
            return $this->redirect(['action' => 'index']);
        }

        //on charcge la table association pour sauvegarder à l'interieur
        $this->loadModel('ArticlesTags');

        if ($this->request->is(['article', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData(), [
                'accessibleFields' => [
                    'tags' => false
                ]
            ]);
            $article->tags = [];
            if ($this->Articles->save($article)) {
                //si on a associé des tags au articles :
                if ($this->request->getData('tags._ids') != null) {
                    //on recupere chaque id du tag
                    foreach ($this->request->getData('tags._ids') as $unTag_id) {
                        //on crée l'enregistrement
                        $leNewTag = $this->ArticlesTags->newEmptyEntity();
                        //on associe au article le tag
                        $leNewTag->article_id = $article->id;
                        $leNewTag->tag_id = $unTag_id;
                        $leNewTag->priority = 5;
                        //on enregistre dans la BDD
                        $this->ArticlesTags->save($leNewTag);
                    }
                }
                $this->Flash->success(__('Votre article a été mis à jour.'));
                return $this->redirect(['action' => 'index']);
            } else
                $this->Flash->error(__('Impossible de mettre à jour votre article.'));
        }
        $this->set(compact('article', 'lesTags')); //on a rajouter les users pour afficher un l'user
    }

    public function delete($id = null) {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $article = $this->Articles->get($id);
            
            if ($article->user_id != $this->Auth->user('id')) {
            $this->Flash->error(__('vous ne pouvez pas supprimer'));
            return $this->redirect(['action' => 'index']);
        }
            if ($this->Articles->delete($article)) {
                $this->Flash->success(__("L'article {0} d' id {1} a bien été supprimé ! ", $article->title, $article->id));
                return $this->redirect(['action' => 'index']);
            }
        } catch (\Exception $ex) {
            $this->Flash->error(__("Vous ne pouvez pas faire cette action"));
            return $this->redirect(['action' => 'index']);
        }
    }

}
