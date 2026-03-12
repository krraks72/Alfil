<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ModulosFixture
 */
class ModulosFixture extends TestFixture
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
                'modulo' => 'Lorem ipsum dolor sit amet',
                'estado' => 1,
                'created' => '2025-03-25 17:49:08',
                'modified' => '2025-03-25 17:49:08',
            ],
        ];
        parent::init();
    }
}
