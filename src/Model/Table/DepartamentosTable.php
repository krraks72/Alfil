<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Departamentos Model
 *
 * @property \App\Model\Table\PaisesTable&\Cake\ORM\Association\BelongsTo $Paises
 * @property \App\Model\Table\MunicipiosTable&\Cake\ORM\Association\HasMany $Municipios
 *
 * @method \App\Model\Entity\Departamento newEmptyEntity()
 * @method \App\Model\Entity\Departamento newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Departamento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Departamento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Departamento findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Departamento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Departamento[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Departamento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Departamento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Departamento[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Departamento[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Departamento[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Departamento[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepartamentosTable extends Table
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

        $this->setTable('departamentos');
        $this->setDisplayField('departamento');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Municipios', [
            'foreignKey' => 'id',
        ]);

        $this->belongsTo('Paises', [
            'foreignKey' => 'paiseId',
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
            ->scalar('codigo')
            ->maxLength('codigo', 10)
            ->requirePresence('codigo', 'create')
            ->notEmptyString('codigo');

        $validator
            ->scalar('departamento')
            ->maxLength('departamento', 100)
            ->requirePresence('departamento', 'create')
            ->notEmptyString('departamento');

        $validator
            ->integer('paiseId')
            ->requirePresence('paiseId', 'create')
            ->notEmptyString('paiseId');

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
