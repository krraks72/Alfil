<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ventanillas Model
 *
 * @property \App\Model\Table\SalasTable&\Cake\ORM\Association\BelongsTo $Salas
 * @property \App\Model\Table\AreasTable&\Cake\ORM\Association\BelongsTo $Areas
 * @property \App\Model\Table\SedesTable&\Cake\ORM\Association\BelongsTo $Sedes
 * @property \App\Model\Table\FilasventanillasTable&\Cake\ORM\Association\HasMany $Filasventanillas
 * 
 * @method \App\Model\Entity\Ventanilla newEmptyEntity()
 * @method \App\Model\Entity\Ventanilla newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ventanilla[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ventanilla get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ventanilla findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ventanilla patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ventanilla[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ventanilla|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ventanilla saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ventanilla[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ventanilla[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ventanilla[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ventanilla[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VentanillasTable extends Table
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

        $this->setTable('ventanillas');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Areas', [
            'foreignKey' => 'areaId',
            'joinType' => 'INNER',
        ]);
        
        $this->belongsTo('Salas', [
            'foreignKey' => 'salaId',
            'joinType' => 'INNER',
        ]);
        
        $this->belongsTo('Sedes', [
            'foreignKey' => 'sedeId',
            'joinType' => 'INNER',
        ]);
        
        $this->hasMany('Filasventanillas', [
            'foreignKey' => 'ventanillaId',
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
            ->scalar('ventanilla')
            ->maxLength('ventanilla', 30)
            ->requirePresence('ventanilla', 'create')
            ->notEmptyString('ventanilla');

        $validator
            ->integer('areaId')
            ->requirePresence('areaId', 'create')
            ->notEmptyString('areaId');

        $validator
            ->integer('sedeId')
            ->requirePresence('sedeId', 'create')
            ->notEmptyString('sedeId');

        $validator
            ->integer('salaId')
            ->requirePresence('salaId', 'create')
            ->notEmptyString('salaId');

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
