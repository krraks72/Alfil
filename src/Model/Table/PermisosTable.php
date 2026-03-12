<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Permisos Model
 *
 * @property \App\Model\Table\OpcionesTable&\Cake\ORM\Association\BelongsTo $Opciones
 * @property \App\Model\Table\PerfilesTable&\Cake\ORM\Association\BelongsTo $Perfiles
 *
 * @method \App\Model\Entity\Permiso newEmptyEntity()
 * @method \App\Model\Entity\Permiso newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Permiso[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Permiso get($primaryKey, $options = [])
 * @method \App\Model\Entity\Permiso findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Permiso patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Permiso[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Permiso|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Permiso saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Permiso[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Permiso[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Permiso[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Permiso[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PermisosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('permisos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Perfiles', [
            'foreignKey' => 'perfileId',
            'joinType' => 'INNER',
        ]);
        
        $this->belongsTo('Opciones', [
            'foreignKey' => 'opcioneId',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('perfileId')
            ->requirePresence('perfileId', 'create')
            ->notEmptyFile('perfileId');

        $validator
            ->integer('opcioneId')
            ->requirePresence('opcioneId', 'create')
            ->notEmptyString('opcioneId');

        $validator
            ->boolean('leer')
            ->requirePresence('leer', 'create')
            ->notEmptyString('leer');

        $validator
            ->boolean('editar')
            ->requirePresence('editar', 'create')
            ->notEmptyString('editar');

        $validator
            ->boolean('crear')
            ->requirePresence('crear', 'create')
            ->notEmptyString('crear');

        $validator
            ->boolean('eliminar')
            ->requirePresence('eliminar', 'create')
            ->notEmptyString('eliminar');

        $validator
            ->boolean('estado')
            ->requirePresence('estado', 'create')
            ->notEmptyString('estado');

        $validator
            ->scalar('usuarioCrea')
            ->maxLength('usuarioCrea', 50)
            ->requirePresence('usuarioCrea', 'create')
            ->notEmptyString('usuarioCrea');

        $validator
            ->scalar('usuarioMod') 
            ->maxLength('usuarioMod', 50)
            ->allowEmptyString('usuarioMod');

        return $validator;
    }
}
