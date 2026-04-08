<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaisesFixture
 */
class PaisesFixture extends TestFixture
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
                'pais' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'iso2' => 'Lo',
                'iso3' => 'Lo',
                'codePhone' => 'Lor',
                'estado' => 1,
                'created' => '2025-03-25 17:33:26',
                'modified' => '2025-03-25 17:33:26',
            ],
        ];
        parent::init();
    }
}
