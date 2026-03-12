<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IpssFixture
 */
class IpssFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'ipss';
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
                'codigoReps' => 'Lorem ip',
                'sigla' => 'Lorem ipsu',
                'nit' => 'Lorem ipsu',
                'digito' => 1,
                'ips' => 'Lorem ipsum dolor sit amet',
                'direccion' => 'Lorem ipsum dolor sit amet',
                'municipioId' => 1,
                'empresaId' => 1,
                'estado' => 1,
                'created' => '2025-03-28 17:29:42',
                'modified' => '2025-03-28 17:29:42',
            ],
        ];
        parent::init();
    }
}
