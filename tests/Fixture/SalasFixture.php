<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalasFixture
 */
class SalasFixture extends TestFixture
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
                'sala' => 'Lorem ipsum dolor sit amet',
                'sedeId' => 1,
                'estado' => 1,
                'usuarioCrea' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-12-15 11:38:02',
                'usuarioMod' => 'Lorem ipsum dolor sit amet',
                'modified' => '2025-12-15 11:38:02',
            ],
        ];
        parent::init();
    }
}
