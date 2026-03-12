<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Prioridades Model
 *
 * @property \App\Model\Table\FilasTable&\Cake\ORM\Association\HasMany $Filas
 *
 * @method \App\Model\Entity\Prioridade newEmptyEntity()
 * @method \App\Model\Entity\Prioridade newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade get($primaryKey, $options = [])
 * @method \App\Model\Entity\Prioridade findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Prioridade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Prioridade|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prioridade saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Prioridade[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Prioridade[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Prioridade[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Prioridade[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PrioridadesTable extends Table
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

        $this->setTable('prioridades');
        $this->setDisplayField('prioridad');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Filas', [
            'foreignKey' => 'prioridadeId',
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
            ->scalar('prioridad')
            ->maxLength('prioridad', 50)
            ->requirePresence('prioridad', 'create')
            ->notEmptyString('prioridad');

        $validator
            ->boolean('estado')
            ->notEmptyString('estado');

        $validator
            ->scalar('usuarioCrea')
            ->maxLength('usuarioCrea', 50)
            ->notEmptyString('usuarioCrea');

        $validator
            ->scalar('usuarioMod')
            ->maxLength('usuarioMod', 50)
            ->allowEmptyString('usuarioMod');

        return $validator;
    }
}
