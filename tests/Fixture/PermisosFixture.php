<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PermisosFixture
 */
class PermisosFixture extends TestFixture
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
                'perfileId' => 1,
                'opcioneId' => 1,
                'leer' => 1,
                'editar' => 1,
                'crear' => 1,
                'eliminar' => 1,
                'created' => '2025-03-14 20:57:31',
                'modified' => '2025-03-14 20:57:31',
            ],
        ];
        parent::init();
    }
}
