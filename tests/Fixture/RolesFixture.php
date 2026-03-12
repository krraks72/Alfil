<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RolesFixture
 */
class RolesFixture extends TestFixture
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
                'rol' => 'Lorem ipsum dolor sit amet',
                'perfileId' => 1,
                'estado' => 1,
                'created' => '2025-03-04 16:26:54',
                'modified' => '2025-03-04 16:26:54',
            ],
        ];
        parent::init();
    }
}
