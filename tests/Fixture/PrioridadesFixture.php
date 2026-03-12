<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PrioridadesFixture
 */
class PrioridadesFixture extends TestFixture
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
                'prioridad' => 'Lorem ipsum dolor sit amet',
                'estado' => 1,
                'usuarioCrea' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-01-27 09:50:49',
                'usuarioMod' => 'Lorem ipsum dolor sit amet',
                'modified' => '2026-01-27 09:50:49',
            ],
        ];
        parent::init();
    }
}
