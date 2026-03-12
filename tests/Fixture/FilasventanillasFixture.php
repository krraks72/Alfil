<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FilasventanillasFixture
 */
class FilasventanillasFixture extends TestFixture
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
                'filaId' => 1,
                'ventanillaId' => 1,
                'estado' => 1,
                'usuarioCrea' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-02-02 11:57:00',
                'usuarioMod' => 'Lorem ipsum dolor sit amet',
                'modified' => '2026-02-02 11:57:00',
            ],
        ];
        parent::init();
    }
}
