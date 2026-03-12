<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ipss Model
 *
 * @property \App\Model\Table\EmpresasTable&\Cake\ORM\Association\BelongsTo $Empresas
 * @property \App\Model\Table\MunicipiosTable&\Cake\ORM\Association\BelongsTo $Municipios
 * @property \App\Model\Table\SedesTable&\Cake\ORM\Association\HasMany $Sedes
 *
 * @method \App\Model\Entity\Ips newEmptyEntity()
 * @method \App\Model\Entity\Ips newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ips[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ips get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ips findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ips patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ips[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ips|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ips saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ips[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ips[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ips[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ips[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IpssTable extends Table
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

        $this->setTable('ipss');
        $this->setDisplayField('codigoReps');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Sedes', [
            'foreignKey' => 'id',
        ]);

        $this->belongsTo('Municipios', [
            'foreignKey' => 'municipioId',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Empresas', [
            'foreignKey' => 'empresaId',
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
            ->scalar('codigoReps')
            ->maxLength('codigoReps', 10)
            ->requirePresence('codigoReps', 'create')
            ->notEmptyString('codigoReps');

        $validator
            ->scalar('sigla')
            ->maxLength('sigla', 12)
            ->requirePresence('sigla', 'create')
            ->notEmptyString('sigla');

        $validator
            ->scalar('nit')
            ->maxLength('nit', 12)
            ->requirePresence('nit', 'create')
            ->notEmptyString('nit');

        $validator
            ->integer('digito')
            ->requirePresence('digito', 'create')
            ->notEmptyString('digito');

        $validator
            ->scalar('ips')
            ->maxLength('ips', 120)
            ->requirePresence('ips', 'create')
            ->notEmptyString('ips');

        $validator
            ->scalar('direccion')
            ->maxLength('direccion', 100)
            ->requirePresence('direccion', 'create')
            ->notEmptyString('direccion');

        $validator
            ->integer('municipioId')
            ->requirePresence('municipioId', 'create')
            ->notEmptyString('municipioId');

        $validator
            ->integer('empresaId')
            ->requirePresence('empresaId', 'create')
            ->notEmptyString('empresaId');

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
