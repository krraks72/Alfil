<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Filasrutas Model
 *
 * @property \App\Model\Table\FilasTable&\Cake\ORM\Association\BelongsTo $Filas
 * @property \App\Model\Table\RutasTable&\Cake\ORM\Association\BelongsTo $Rutas
 * 
 * @method \App\Model\Entity\Filasruta newEmptyEntity()
 * @method \App\Model\Entity\Filasruta newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Filasruta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Filasruta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Filasruta findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Filasruta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Filasruta[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Filasruta|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Filasruta saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Filasruta[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Filasruta[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Filasruta[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Filasruta[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FilasrutasTable extends Table
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

        $this->setTable('filasrutas');
        $this->setDisplayField('usuarioCrea');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');      

        $this->belongsTo('Filas', [
            'foreignKey' => 'filaId',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Rutas', [
            'foreignKey' => 'rutaId',
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
            ->integer('rutaId')
            ->requirePresence('rutaId', 'create')
            ->notEmptyString('rutaId');

        $validator
            ->integer('filaId')
            ->requirePresence('filaId', 'create')
            ->notEmptyString('filaId');

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
