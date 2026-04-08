<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SedesFixture
 */
class SedesFixture extends TestFixture
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
                'codigoReps' => 'Lorem ipsu',
                'habilitacion' => 'Lorem ipsum dolor sit amet',
                'sede' => 'Lorem ipsum dolor sit amet',
                'direccion' => 'Lorem ipsum dolor sit amet',
                'telefono' => 'Lorem ipsum dolor ',
                'municipioId' => 1,
                'ipsId' => 1,
                'estado' => 1,
                'created' => '2025-03-28 17:29:49',
                'modified' => '2025-03-28 17:29:49',
            ],
        ];
        parent::init();
    }
}
