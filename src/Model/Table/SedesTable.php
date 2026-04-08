<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sedes Model
 *
 * @property \App\Model\Table\IpssTable&\Cake\ORM\Association\BelongsTo $Ipss
 * @property \App\Model\Table\MunicipiosTable&\Cake\ORM\Association\BelongsTo $Municipios
 * @property \App\Model\Table\VentanillasTable&\Cake\ORM\Association\HasMany $Ventanillas
 *
 * @method \App\Model\Entity\Sede newEmptyEntity()
 * @method \App\Model\Entity\Sede newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sede[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sede get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sede findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sede patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sede[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sede|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sede saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sede[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sede[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sede[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sede[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SedesTable extends Table
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

        $this->setTable('sedes');
        $this->setDisplayField('codigoReps');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Municipios', [
            'foreignKey' => 'municipioId',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Ipss', [
            'foreignKey' => 'ipsId',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('Ventanillas', [
            'foreignKey' => 'sedeId',
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
            ->scalar('codigoReps')
            ->maxLength('codigoReps', 12)
            ->requirePresence('codigoReps', 'create')
            ->notEmptyString('codigoReps');

        $validator
            ->scalar('habilitacion')
            ->maxLength('habilitacion', 50)
            ->requirePresence('habilitacion', 'create')
            ->notEmptyString('habilitacion');

        $validator
            ->scalar('sede')
            ->maxLength('sede', 100)
            ->requirePresence('sede', 'create')
            ->notEmptyString('sede');

        $validator
            ->scalar('direccion')
            ->maxLength('direccion', 100)
            ->requirePresence('direccion', 'create')
            ->notEmptyString('direccion');

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 20)
            ->requirePresence('telefono', 'create')
            ->notEmptyString('telefono');

        $validator
            ->integer('municipioId')
            ->requirePresence('municipioId', 'create')
            ->notEmptyString('municipioId');

        $validator
            ->integer('ipsId')
            ->requirePresence('ipsId', 'create')
            ->notEmptyString('ipsId');

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
