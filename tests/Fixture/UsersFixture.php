<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'nombre' => 'Lorem ipsum dolor sit amet',
                'tipoId' => 1,
                'documento' => 'Lorem ipsum dolor ',
                'celular' => 'Lorem ipsum dolor ',
                'roleId' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'usuario' => 'Lorem ipsum dolor ',
                'password' => 'Lorem ipsum dolor sit amet',
                'estado' => 1,
                'created' => '2025-03-04 15:28:03',
                'modified' => '2025-03-04 15:28:03',
            ],
        ];
        parent::init();
    }
}
