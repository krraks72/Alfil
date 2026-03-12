<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MunicipiosFixture
 */
class MunicipiosFixture extends TestFixture
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
                'municipio' => 'Lorem ipsum dolor sit amet',
                'departamentoId' => 1,
                'estado' => 1,
                'created' => '2025-03-25 17:32:45',
                'modified' => '2025-03-25 17:32:45',
            ],
        ];
        parent::init();
    }
}
