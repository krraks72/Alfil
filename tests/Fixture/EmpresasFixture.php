<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmpresasFixture
 */
class EmpresasFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'razonSocial' => 'Lorem ipsum dolor sit amet',
                'nit' => 'Lorem ipsu',
                'digito' => 1,
                'representante' => 'Lorem ipsum dolor sit amet',
                'direccion' => 'Lorem ipsum dolor sit amet',
                'telefono' => 'Lorem ipsum dolor ',
                'municipioId' => 1,
                'estado' => 1,
                'created' => '2025-03-25 17:32:11',
                'modified' => '2025-03-25 17:32:11',
            ],
        ];
        parent::init();
    }
}
