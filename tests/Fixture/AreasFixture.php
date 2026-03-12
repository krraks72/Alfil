<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AreasFixture
 */
class AreasFixture extends TestFixture
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
                'area' => 'Lorem ipsum dolor sit amet',
                'ipsId' => 1,
                'estado' => 1,
                'usuarioCrea' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-12-15 09:42:18',
                'usuarioMod' => 'Lorem ipsum dolor sit amet',
                'modified' => '2025-12-15 09:42:18',
            ],
        ];
        parent::init();
    }
}
