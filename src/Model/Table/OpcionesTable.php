<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Opciones Model
 *
 * @property \App\Model\Table\ModulossTable&\Cake\ORM\Association\BelongsTo $Modulos
 * @property \App\Model\Table\PermisosTable&\Cake\ORM\Association\HasMany $Permisos *
 *
 * @method \App\Model\Entity\Opcione newEmptyEntity()
 * @method \App\Model\Entity\Opcione newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Opcione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Opcione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Opcione findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Opcione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Opcione[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Opcione|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Opcione saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Opcione[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Opcione[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Opcione[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Opcione[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OpcionesTable extends Table
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

        $this->setTable('opciones');
        $this->setDisplayField('opcion');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Modulos', [
            'foreignKey' => 'moduloId',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('Permisos', [
            'foreignKey' => 'id',
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
            ->scalar('opcion')
            ->maxLength('opcion', 100)
            ->requirePresence('opcion', 'create')
            ->notEmptyString('opcion');

        $validator
            ->scalar('etiqueta')
            ->maxLength('etiqueta', 100)
            ->requirePresence('etiqueta', 'create')
            ->notEmptyString('etiqueta');
            
        $validator
            ->integer('moduloId')
            ->requirePresence('moduloId', 'create')
            ->notEmptyString('moduloId');

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
