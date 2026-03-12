<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FilasFixture
 */
class FilasFixture extends TestFixture
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
                'Fila' => 'Lorem ipsum dolor sit amet',
                'prioritaria' => 1,
                'prioridadeId' => 1,
                'validaGenero' => 1,
                'generoId' => 1,
                'edad' => 1,
                'edadInicial' => 1,
                'edadFinal' => 1,
                'estado' => 1,
                'usuarioCrea' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-01-27 09:50:56',
                'usuarioMod' => 'Lorem ipsum dolor sit amet',
                'modified' => '2026-01-27 09:50:56',
            ],
        ];
        parent::init();
    }
}
