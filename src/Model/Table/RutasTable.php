<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rutas Model
 * 
 * @property \App\Model\Table\FilasrutasTable&\Cake\ORM\Association\HasMany $Filasrutas
 * @property \App\Model\Table\SalasrutasTable&\Cake\ORM\Association\HasMany $Salasrutas
 * 
 * @method \App\Model\Entity\Ruta newEmptyEntity()
 * @method \App\Model\Entity\Ruta newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ruta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ruta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ruta findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ruta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ruta[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ruta|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ruta saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ruta[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ruta[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ruta[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ruta[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RutasTable extends Table
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

        $this->setTable('rutas');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('Salasrutas', [
            'foreignKey' => 'rutaId',
        ]);
        
        $this->hasMany('Filasrutas', [
            'foreignKey' => 'rutaId',
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
            ->scalar('ruta')
            ->maxLength('ruta', 50)
            ->requirePresence('ruta', 'create')
            ->notEmptyString('ruta');

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
