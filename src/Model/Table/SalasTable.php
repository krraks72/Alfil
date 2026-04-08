<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Salas Model
 *
 * @property \App\Model\Table\SedesTable&\Cake\ORM\Association\BelongsTo $Sedes
 * @property \App\Model\Table\VentanillasTable&\Cake\ORM\Association\HasMany $Ventanillas
 * @property \App\Model\Table\SalasrutasTable&\Cake\ORM\Association\HasMany $Salasrutas
 * 
 * @method \App\Model\Entity\Sala newEmptyEntity()
 * @method \App\Model\Entity\Sala newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sala[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sala get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sala findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sala patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sala[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sala|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sala saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalasTable extends Table
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

        $this->setTable('salas');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Sedes', [
            'foreignKey' => 'sedeId',
            'joinType' => 'INNER',
        ]);
        
        $this->hasMany('Ventanillas', [
            'foreignKey' => 'salaId',
        ]);
        
        $this->hasMany('Salasrutas', [
            'foreignKey' => 'salaId',
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
            ->maxLength('codigo', 12)
            ->requirePresence('codigo', 'create')
            ->notEmptyString('codigo');

        $validator
            ->scalar('sala')
            ->maxLength('sala', 30)
            ->requirePresence('sala', 'create')
            ->notEmptyString('sala');

        $validator
            ->integer('sedeId')
            ->requirePresence('sedeId', 'create')
            ->notEmptyString('sedeId');

        $validator
            ->boolean('estado')
            ->requirePresence('estado', 'create')
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
