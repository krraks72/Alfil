<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Municipios Controller
 *
 * @property \App\Model\Table\MunicipiosTable $Municipios
 * @method \App\Model\Entity\Municipio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MunicipiosController extends AppController
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

        if (!HelperController::verificarPermiso('Municipios', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('municipioId');

        $this->paginate = ['contain' => ['Departamentos'],];

        $municipios = $this->paginate($this->Municipios);
        $this->set(compact('municipios', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Municipio id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Municipios', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('municipioId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('municipioId');

        $municipio = $this->Municipios->get($id, ['contain' => ['Departamentos'],]);
        $this->set(compact('municipio', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Municipios', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $municipio = $this->Municipios->newEmptyEntity();
        if ($this->request->is('post')) {
            $municipio = $this->Municipios->patchEntity($municipio, $this->request->getData());
            $municipio->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Municipios->save($municipio)) {
                $this->Flash->success(__('El municipio ha sido creado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el municipio. Inténtelo de nuevo.'));
        }

        $departamentos = $this->Municipios->Departamentos->find('list', ['keyField' => 'id', 'valueField' => 'departamento', 'order' => ['departamento' => 'ASC']])->where(['estado' => 1])->limit(200)->all();

        $this->set(compact('municipio', 'departamentos', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Municipio id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Municipios', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('municipioId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $municipio = $this->Municipios->get($id, ['contain' => ['Departamentos'],]);
        $municipio->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $municipio = $this->Municipios->patchEntity($municipio, $this->request->getData());
            if ($this->Municipios->save($municipio)) {
                $this->Flash->success(__('El municipio ha sido guardado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el municipio. Inténtelo de nuevo.'));
        }

        $departamentos = $this->Municipios->Departamentos->find('list', ['keyField' => 'id', 'valueField' => 'departamento', 'order' => ['departamento' => 'ASC']])->where(['estado' => 1])->limit(200)->all();

        $this->set(compact('municipio', 'departamentos', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Municipio id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Municipios', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $municipio = $this->Municipios->get($id);
        if ($this->Municipios->delete($municipio)) {
            $this->Flash->success(__('El municipio ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el municipio. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Municipio id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Municipios', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $municipio = $this->Municipios->get($id);
        $municipio->estado = 0; // Cambia el estado a inactivo
        $municipio->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Municipios->save($municipio)) {
            $this->Flash->success(__('El municipio ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el municipio. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Municipio id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Municipios', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $municipio = $this->Municipios->get($id);
        $municipio->estado = 1; // Cambia el estado a activo
        $municipio->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Municipios->save($municipio)) {
            $this->Flash->success(__('El municipio ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el municipio. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerMunicipio method
     *
     * @param string|null $id Municipio id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verMunicipio($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('municipioId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarMunicipio method
     *
     * @param string|null $id Municipio id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarMunicipio($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('municipioId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
