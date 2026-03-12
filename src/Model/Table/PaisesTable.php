<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Paises Model
 *
 * @property \App\Model\Table\DepartamentosTable&\Cake\ORM\Association\HasMany $Departamentos
 *
 * @method \App\Model\Entity\Paise newEmptyEntity()
 * @method \App\Model\Entity\Paise newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Paise[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Paise get($primaryKey, $options = [])
 * @method \App\Model\Entity\Paise findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Paise patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Paise[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Paise|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paise saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Paise[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paise[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paise[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Paise[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PaisesTable extends Table
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

        $this->setTable('paises');
        $this->setDisplayField('pais');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Departamentos', [
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
            ->scalar('pais')
            ->maxLength('pais', 100)
            ->requirePresence('pais', 'create')
            ->notEmptyString('pais');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('iso2')
            ->maxLength('iso2', 4)
            ->requirePresence('iso2', 'create')
            ->notEmptyString('iso2');

        $validator
            ->scalar('iso3')
            ->maxLength('iso3', 4)
            ->requirePresence('iso3', 'create')
            ->notEmptyString('iso3');

        $validator
            ->scalar('codePhone')
            ->maxLength('codePhone', 5)
            ->allowEmptyString('codePhone');

        $validator
            ->boolean('estado')
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
