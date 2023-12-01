<?php

namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController {

    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Mauvais nom utilisateur ou mot de passe, veuillez réessayer'));
        }
    }

    public function logout() {
        $this->Flash->success(__('deconnexion réussie'));
        return $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->paginate = [
            'contain' => [
                'Articles' => function ($q) {
                    return $q
                            ->select(['user_id']);
                }]
        ];
        //On  récupére  tous  les  users  et  on  les  stocke  dans $mesUsers
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));  //Envoie  à  la  vue  le contenu de $mesUsersdans $rep qui sera utiliseable
    }

    public function view($id = null) {
        try {
            $user = $this->Users->get($id, [
                'contain' => [
                    'Articles' => function ($q) {
                        return $q->select(['id', 'title', 'created', 'user_id']);
                    },
                    'Comments' => function ($q) {
                        return $q->select(['id', 'title', 'created', 'user_id']);
                    }
                ]
            ]);
        } catch (\Exception $e) {
            if ($id == null) {
                $this->Flash->error(__("L'action view doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L'user {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('user'));
    }

    public function add() {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__("Le user a été sauvegardé."));
                return $this->redirect(['action' => 'index']);
            } else
                $this->Flash->error(__("Impossible d'ajouter votre user."));
        }
        $this->set(compact('user'));
    }

    Public function edit($id = null) {
        try {
            $user = $this->Users->get($id);
        } catch (\Exception $ex) {
            if ($id == null) {
                $this->Flash->error(__("L'user edit doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L'user {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }

        if ($user->id != $this->Auth->user('id')) {
            $this->Flash->error(__('vous ne pouvez pas faire cette modification.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Users->patchEntity($user, $this->request->getdata());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Votre user a été mis à jour.'));
                $this->logout();
            } else
                $this->Flash->error(__('Impossible de mettre à jour votre user.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null) {
        try {
            $this->request->allowMethod(['post', 'delete']);
            $user = $this->Users->get($id);

            if ($user->id != $this->Auth->user('id')) {
                $this->Flash->error(__('vous ne pouvez pas supprimer un autre utilisateur'));
                return $this->redirect(['action' => 'index']);
            }
            if ($this->Users->delete($user)) {
                $this->Flash->success(__("L'user {0} d' id {1} a bien été supprimé ! ", $user->username, $user->id));
                $this->logout();
            }
        } catch (\Exception $ex) {
            $this->Flash->success("Vous ne pouvez plus utiliser cette fonction");
            return $this->redirect(['action' => 'index']);
        }
    }

}
