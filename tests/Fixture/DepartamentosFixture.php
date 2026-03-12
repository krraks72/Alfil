<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DepartamentosFixture
 */
class DepartamentosFixture extends TestFixture
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
                'codigo' => 'Lorem ip',
                'departamento' => 'Lorem ipsum dolor sit amet',
                'paisId' => 1,
                'estado' => 1,
                'created' => '2025-03-25 17:32:00',
                'modified' => '2025-03-25 17:32:00',
            ],
        ];
        parent::init();
    }
}
