<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Filasventanillas Model
 *
 * @property \App\Model\Table\FilasTable&\Cake\ORM\Association\BelongsTo $Filas
 * @property \App\Model\Table\VentanillasTable&\Cake\ORM\Association\BelongsTo $Ventanillas
 * 
 * @method \App\Model\Entity\Filasventanilla newEmptyEntity()
 * @method \App\Model\Entity\Filasventanilla newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Filasventanilla[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Filasventanilla get($primaryKey, $options = [])
 * @method \App\Model\Entity\Filasventanilla findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Filasventanilla patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Filasventanilla[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Filasventanilla|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Filasventanilla saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Filasventanilla[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Filasventanilla[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Filasventanilla[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Filasventanilla[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FilasventanillasTable extends Table
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

        $this->setTable('filasventanillas');
        $this->setDisplayField('usuarioCrea');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');     

        $this->belongsTo('Filas', [
            'foreignKey' => 'filaId',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Ventanillas', [
            'foreignKey' => 'ventanillaId',
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
            ->integer('filaId')
            ->requirePresence('filaId', 'create')
            ->notEmptyString('filaId');

        $validator
            ->integer('ventanillaId')
            ->requirePresence('ventanillaId', 'create')
            ->notEmptyString('ventanillaId');

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
