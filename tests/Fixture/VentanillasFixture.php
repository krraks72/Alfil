<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VentanillasFixture
 */
class VentanillasFixture extends TestFixture
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
                'codigo' => 'Lorem ipsu',
                'Ventanilla' => 'Lorem ipsum dolor sit amet',
                'areaId' => 1,
                'sedeId' => 1,
                'salaId' => 1,
                'estado' => 1,
                'usuarioCrea' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-12-15 11:37:33',
                'usuarioMod' => 'Lorem ipsum dolor sit amet',
                'modified' => '2025-12-15 11:37:33',
            ],
        ];
        parent::init();
    }
}
