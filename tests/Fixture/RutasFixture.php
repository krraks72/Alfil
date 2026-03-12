<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RutasFixture
 */
class RutasFixture extends TestFixture
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
                'codigo' => 'Lorem ipsum dolor sit amet',
                'ruta' => 'Lorem ipsum dolor sit amet',
                'estado' => 1,
                'usuarioCrea' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-02-02 10:49:53',
                'usuarioMod' => 'Lorem ipsum dolor sit amet',
                'modified' => '2026-02-02 10:49:53',
            ],
        ];
        parent::init();
    }
}
