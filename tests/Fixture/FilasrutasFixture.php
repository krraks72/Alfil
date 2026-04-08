<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FilasrutasFixture
 */
class FilasrutasFixture extends TestFixture
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
                'rutaId' => 1,
                'filaId' => 1,
                'estado' => 1,
                'usuarioCrea' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-02-02 11:56:38',
                'usuarioMod' => 'Lorem ipsum dolor sit amet',
                'modified' => '2026-02-02 11:56:38',
            ],
        ];
        parent::init();
    }
}
