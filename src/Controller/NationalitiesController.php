<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Nationalities Controller
 *
 * @property \App\Model\Table\NationalitiesTable $Nationalities
 * @method \App\Model\Entity\Nationality[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NationalitiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
       $this->paginate = [
            
        ];

        $this->set(compact('nationalities'));
    }

    /**
     * View method
     *
     * @param string|null $id Nationality id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nationality = $this->Nationalities->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('nationality'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nationality = $this->Nationalities->newEmptyEntity();
        if ($this->request->is('post')) {
            $nationality = $this->Nationalities->patchEntity($nationality, $this->request->getData());
            if ($this->Nationalities->save($nationality)) {
                $this->Flash->success(__('The nationality has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nationality could not be saved. Please, try again.'));
        }
        $this->set(compact('nationality'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Nationality id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nationality = $this->Nationalities->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nationality = $this->Nationalities->patchEntity($nationality, $this->request->getData());
            if ($this->Nationalities->save($nationality)) {
                $this->Flash->success(__('The nationality has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nationality could not be saved. Please, try again.'));
        }
        $this->set(compact('nationality'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Nationality id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nationality = $this->Nationalities->get($id);
        if ($this->Nationalities->delete($nationality)) {
            $this->Flash->success(__('The nationality has been deleted.'));
        } else {
            $this->Flash->error(__('The nationality could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
