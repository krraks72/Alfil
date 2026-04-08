<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TiposFixture
 */
class TiposFixture extends TestFixture
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
                'tipo' => 'Lorem ipsum dolor sit amet',
                'estado' => 1,
                'created' => '2025-03-04 14:57:14',
                'modified' => '2025-03-04 14:57:14',
            ],
        ];
        parent::init();
    }
}
