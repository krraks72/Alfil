<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OpcionesFixture
 */
class OpcionesFixture extends TestFixture
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
                'opcion' => 'Lorem ipsum dolor sit amet',
                'moduloId' => 1,
                'estado' => 1,
                'created' => '2025-03-25 17:33:07',
                'modified' => '2025-03-25 17:33:07',
            ],
        ];
        parent::init();
    }
}
