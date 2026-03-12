<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ipss Controller
 *
 * @property \App\Model\Table\IpssTable $Ipss
 * @method \App\Model\Entity\Ips[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IpssController extends AppController
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

        if (!HelperController::verificarPermiso('Ipss', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('ipsId');
        
        $ipss = $this->paginate($this->Ipss);

        $this->set(compact('ipss', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Ips id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Ipss', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('ipsId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('ipsId');

        $ips = $this->Ipss->get($id, ['contain' => ['Municipios', 'Empresas'],]);

        $this->set(compact('ips', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Ipss', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $ips = $this->Ipss->newEmptyEntity();
        if ($this->request->is('post')) {
            $ips = $this->Ipss->patchEntity($ips, $this->request->getData());
            $ips->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Ipss->save($ips)) {
                $this->Flash->success(__('La Ips ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la ips. Inténtelo de nuevo.'));
        }
        
        $municipios = $this->Ipss->Municipios->find('list', ['keyField' => 'id', 'valueField' => 'municipio', 'order' => ['municipio' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $empresas = $this->Ipss->Empresas->find('list', ['keyField' => 'id', 'valueField' => 'razonSocial', 'order' => ['razonSocial' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $this->set(compact('ips', 'municipios', 'empresas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ips id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Ipss', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('ipsId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $ips = $this->Ipss->get($id, ['contain' => ['Municipios', 'Empresas'],]);
        $ips->usuarioMod = HelperController::obtenerUsuario();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ips = $this->Ipss->patchEntity($ips, $this->request->getData());
            if ($this->Ipss->save($ips)) {
                $this->Flash->success(__('La ips ha sido guardada.'));
                $this->request->getSession()->delete('ipsId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la ips. Inténtelo de nuevo.'));
        }        
        
        $municipios = $this->Ipss->Municipios->find('list', ['keyField' => 'id', 'valueField' => 'municipio', 'order' => ['municipio' => 'ASC']])->where(['estado' => 1])->limit(2000)->all();
        $empresas = $this->Ipss->Empresas->find('list', ['keyField' => 'id', 'valueField' => 'razonSocial', 'order' => ['razonSocial' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $this->set(compact('ips', 'municipios', 'empresas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ips id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Ipss', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $ips = $this->Ipss->get($id);
        if ($this->Ipss->delete($ips)) {
            $this->Flash->success(__('La ips ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la ips. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Ips id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Ipss', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $ips = $this->Ipss->get($id);
        $ips->estado = 0; // Cambia el estado a inactivo
        $ips->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Sedes->save($ips)) {
            $this->Flash->success(__('La ips ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la ips. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Ips id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Ipss', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $ips = $this->Ipss->get($id);
        $ips->estado = 1; // Cambia el estado a activo
        $ips->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Ipss->save($ips)) {
            $this->Flash->success(__('La ips ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la ips. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerIps method
     *
     * @param string|null $id Ips id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verIps($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('ipsId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarIps method
     *
     * @param string|null $id Ips id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarIps($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('ipsId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
