<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Empresas Controller
 *
 * @property \App\Model\Table\EmpresasTable $Empresas
 * @method \App\Model\Entity\Empresa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmpresasController extends AppController
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

        if (!HelperController::verificarPermiso('Empresas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('empresaId');

        $this->paginate = ['contain' => ['Municipios'],];

        $empresas = $this->paginate($this->Empresas);
        $this->set(compact('empresas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Empresas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('empresaId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('empresaId');

        $empresa = $this->Empresas->get($id, ['contain' => ['Municipios'],]);
        $this->set(compact('empresa', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Empresas', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $empresa = $this->Empresas->newEmptyEntity();
        if ($this->request->is('post')) {
            $empresa = $this->Empresas->patchEntity($empresa, $this->request->getData());
            $empresa->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Empresas->save($empresa)) {
                $this->Flash->success(__('La empresa ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la empresa. Inténtelo de nuevo.'));
        }

        $municipios = $this->Empresas->Municipios->find('list', ['keyField' => 'id', 'valueField' => 'municipio', 'order' => ['municipio' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
 
        $this->set(compact('empresa', 'municipios', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Empresas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('empresaId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $empresa = $this->Empresas->get($id, ['contain' => ['Municipios'],]);
        $empresa->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $empresa = $this->Empresas->patchEntity($empresa, $this->request->getData());
            if ($this->Empresas->save($empresa)) {
                $this->Flash->success(__('La empresa ha sido guardada.'));
                $this->request->getSession()->delete('empresaId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la empresa. Inténtelo de nuevo.'));
        }

        $municipios = $this->Empresas->Municipios->find('list', ['keyField' => 'id', 'valueField' => 'municipio', 'order' => ['municipio' => 'ASC']])->where(['estado' => 1])->limit(200)->all();

        $this->set(compact('empresa', 'municipios', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Empresas', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $empresa = $this->Empresas->get($id);
        if ($this->Empresas->delete($empresa)) {
            $this->Flash->success(__('La empresa ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la empresa. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Empresas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $empresa = $this->Empresas->get($id);
        $empresa->estado = 0; // Cambia el estado a inactivo
        $empresa->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Empresas->save($empresa)) {
            $this->Flash->success(__('La empresa ha sido inactivada.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la empresa. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Empresas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $empresa = $this->Empresas->get($id);
        $empresa->estado = 1; // Cambia el estado a activo
        $empresa->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Empresas->save($empresa)) {
            $this->Flash->success(__('La empresa ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la empresa. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerEmpresa method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verEmpresa($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('empresaId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarEmpresa method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarEmpresa($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('empresaId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
