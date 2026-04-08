<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PerfilesFixture
 */
class PerfilesFixture extends TestFixture
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
                'perfil' => 'Lorem ipsum dolor sit amet',
                'estado' => 1,
                'created' => '2025-03-04 16:24:00',
                'modified' => '2025-03-04 16:24:00',
            ],
        ];
        parent::init();
    }
}
