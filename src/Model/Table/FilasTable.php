<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Filas Model
 *
 * @property \App\Model\Table\GenerosTable&\Cake\ORM\Association\BelongsTo $Generos
 * @property \App\Model\Table\PrioridadesTable&\Cake\ORM\Association\BelongsTo $Prioridades
 * @property \App\Model\Table\FilasrutasTable&\Cake\ORM\Association\HasMany $Filasrutas
 * @property \App\Model\Table\FilasventanillasTable&\Cake\ORM\Association\HasMany $Filasventanillas
 * 
 * @method \App\Model\Entity\Fila newEmptyEntity()
 * @method \App\Model\Entity\Fila newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Fila[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fila get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fila findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Fila patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fila[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fila|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fila saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fila[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fila[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fila[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fila[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FilasTable extends Table
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

        $this->setTable('filas');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');       

        $this->belongsTo('Generos', [
            'foreignKey' => 'generoId',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('Prioridades', [
            'foreignKey' => 'prioridadeId',
            'joinType' => 'LEFT',
        ]);
        
        $this->hasMany('Filasrutas', [
            'foreignKey' => 'filaId', 
        ]);
        
        $this->hasMany('Filasventanillas', [
            'foreignKey' => 'filaId',
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
            ->maxLength('codigo', 50)
            ->requirePresence('codigo', 'create')
            ->notEmptyString('codigo');

        $validator
            ->scalar('fila')
            ->maxLength('fila', 50)
            ->requirePresence('fila', 'create')
            ->notEmptyString('fila');

        $validator
            ->boolean('prioritaria')
            ->allowEmptyString('prioritaria');

        $validator
            ->integer('prioridadeId')
            ->allowEmptyString('prioridadeId');

        $validator
            ->boolean('validaGenero')
            ->allowEmptyString('validaGenero');

        $validator
            ->boolean('infancia')
            ->allowEmptyString('infancia');

        $validator
            ->boolean('discapacidad')
            ->allowEmptyString('discapacidad');

        $validator
            ->integer('generoId')
            ->allowEmptyString('generoId');

        $validator
            ->boolean('edad')
            ->requirePresence('edad', 'create')
            ->notEmptyString('edad');

        $validator
            ->integer('edadInicial')
            ->allowEmptyString('edadInicial');

        $validator
            ->integer('edadFinal')
            ->allowEmptyString('edadFinal');

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
