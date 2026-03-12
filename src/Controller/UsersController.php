<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Cache\Cache;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    private const PASSWORD_PATTERN = '/^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{10,}$/';

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Users', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('usuarioId');

        $this->paginate = ['contain' => ['Tipos', 'Roles'],];

        $users = $this->paginate($this->Users);
        $this->set(compact('users', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Users', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('usuarioId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('usuarioId');

        $user = $this->Users->get($id, ['contain' => ['Tipos', 'Roles'],]);
        $this->set(compact('user', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Users', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ((strlen($data['password']) < 10) || (!preg_match(self::PASSWORD_PATTERN, $data['password']))) {
                $this->Flash->error(__('El password debe tener al menos 10 caracteres, una mayúscula, un número y un carácter especial.'));
            } else {
                $user = $this->Users->patchEntity($user, $data);
                $user->usuarioCrea = HelperController::obtenerUsuario();
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('El usuario ha sido creado.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('No se pudo crear el usuario. Inténtelo de nuevo.'));
            }
        }

        $tipos = $this->Users->Tipos->find('list', ['keyField' => 'id', 'valueField' => 'tipo', 'order' => ['tipo' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $roles = $this->Users->Roles->find('list', ['keyField' => 'id', 'valueField' => 'rol', 'order' => ['rol' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('user', 'tipos', 'roles', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Users', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('usuarioId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->get($id, ['contain' => ['Tipos', 'Roles'],]);
        $user->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if ((strlen($data['password']) < 10) || (!preg_match(self::PASSWORD_PATTERN, $data['password']))) {
                $this->Flash->error(__('El password debe tener al menos 10 caracteres, una mayúscula, un número y un carácter especial.'));
            } else {
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('El usuario ha sido guardado.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('No se pudo guardar el usuario. Inténtelo de nuevo.'));
            }
        }

        $tipos = $this->Users->Tipos->find('list', ['keyField' => 'id', 'valueField' => 'tipo', 'order' => ['tipo' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $roles = $this->Users->Roles->find('list', ['keyField' => 'id', 'valueField' => 'rol', 'order' => ['rol' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('user', 'tipos', 'roles', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Users', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('El usuario ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el usuario. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Users', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $user = $this->Users->get($id);
        $user->estado = 0; // Cambia el estado a inactivo
        $user->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Users->save($user)) {
            $this->Flash->success(__('El usuario ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el usuario. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Users', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $user = $this->Users->get($id);
        $user->estado = 1; // Cambia el estado a activo
        $user->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Users->save($user)) {
            $this->Flash->success(__('El usuario ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el usuario. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Find method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function find()
    {
        $documento = HelperController::obtenerAutenticacionUsuario();
        $users = $this->paginate($this->Users->find()->where(['documento' => $documento]));

        $this->set(compact('users'));
    }

    /**
     * Change method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful change, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function change()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Users', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $id = $this->request->getSession()->read('usuarioId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->get($id, ['contain' => ['Tipos', 'Roles'],]);
       
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if ($data['password'] !== $data['confirPass']) {
                $this->Flash->error(__('Los password no coinciden'));
            } elseif ((strlen($data['password']) < 10) || (!preg_match(self::PASSWORD_PATTERN, $data['password']))) {
                $this->Flash->error(__('El password debe tener al menos 10 caracteres, una mayúscula, un número y un carácter especial.'));
            } else {
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('El password ha sido cambiado.'));
                    return $this->redirect(['controller' => 'Home', 'action' => 'index']);
                }
                $this->Flash->error(__('No se pudo cambiar el password. Inténtelo de nuevo.'));
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects on Invalido usuario o password, renders view otherwise.
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Home',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Usuario o password inválido'));
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void|Authentication.
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void Redirects, renders view otherwise.
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $this->Authentication->logout();
            Cache::clearAll();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    /**
     * VerUsuario method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function verUsuario($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('usuarioId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarUsuario method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarUsuario($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('usuarioId', $id);
        return $this->redirect(['action' => 'edit']);
    }

    /**
     * CambiarPassword method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cambiarPassword($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('usuarioId', $id);
        return $this->redirect(['action' => 'change']);
    }
}
