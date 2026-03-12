<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EspecialidadesFixture
 */
class EspecialidadesFixture extends TestFixture
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
                'codigo' => 'Lor',
                'especialidad' => 'Lorem ipsum dolor sit amet',
                'estado' => 1,
                'created' => '2025-03-28 17:29:30',
                'modified' => '2025-03-28 17:29:30',
            ],
        ];
        parent::init();
    }
}
