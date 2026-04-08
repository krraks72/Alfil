<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Especialidades Controller
 *
 * @property \App\Model\Table\EspecialidadesTable $Especialidades
 * @method \App\Model\Entity\Especialidade[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EspecialidadesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Especialidades', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('especialidadeId');
    
        $especialidades = $this->paginate($this->Especialidades);
        
        $this->set(compact('especialidades', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Especialidade id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Especialidades', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('especialidadeId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('especialidadeId');

        $especialidade = $this->Especialidades->get($id, ['contain' => [],]);
        $this->set(compact('especialidade', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Especialidades', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $especialidade = $this->Especialidades->newEmptyEntity();
        if ($this->request->is('post')) {
            $especialidade = $this->Especialidades->patchEntity($especialidade, $this->request->getData());
            $especialidade->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Especialidades->save($especialidade)) {
                $this->Flash->success(__('La especialidad ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la especialidad. Inténtelo de nuevo.'));
        }

        $this->set(compact('especialidade', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Especialidade id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Especialidades', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('especialidadeId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $especialidade = $this->Especialidades->get($id, ['contain' => [],]);
        $especialidade->usuarioMod = HelperController::obtenerUsuario();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $especialidade = $this->Especialidades->patchEntity($especialidade, $this->request->getData());
            if ($this->Especialidades->save($especialidade)) {
                $this->Flash->success(__('La especialidad ha sido guardada.'));
                $this->request->getSession()->delete('especialidadeId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la especialidad. Inténtelo de nuevo.'));
        }
        
        $this->set(compact('especialidade', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Especialidade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Especialidades', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $especialidade = $this->Especialidades->get($id);
        if ($this->Especialidades->delete($especialidade)) {
            $this->Flash->success(__('La especialidad ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la especialidad. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Especialidade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Especialidades', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $especialidade = $this->Especialidades->get($id);
        $especialidade->estado = 0; // Cambia el estado a inactivo
        $especialidade->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Especialidades->save($especialidade)) {
            $this->Flash->success(__('La especialidad ha sido inactivada.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar La especialidad Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Especialidade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Especialidades', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $especialidade = $this->Especialidades->get($id);
        $especialidade->estado = 1; // Cambia el estado a activo
        $especialidade->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Especialidades->save($especialidade)) {
            $this->Flash->success(__('La especialidad ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la especialidad. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerEspecialidade method
     *
     * @param string|null $id Especialidade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verEspecialidade($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('especialidadeId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarEspecialidade method
     *
     * @param string|null $id Especialidade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarEspecialidade($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('especialidadeId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
