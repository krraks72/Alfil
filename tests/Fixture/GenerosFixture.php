<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GenerosFixture
 */
class GenerosFixture extends TestFixture
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
                'genero' => 'Lorem ipsum dolor sit amet',
                'estado' => 1,
                'usuarioCrea' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-01-27 09:50:38',
                'usuarioMod' => 'Lorem ipsum dolor sit amet',
                'modified' => '2026-01-27 09:50:38',
            ],
        ];
        parent::init();
    }
}
