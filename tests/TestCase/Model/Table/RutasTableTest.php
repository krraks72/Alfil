<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RutasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RutasTable Test Case
 */
class RutasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RutasTable
     */
    protected $Rutas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Rutas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Rutas') ? [] : ['className' => RutasTable::class];
        $this->Rutas = $this->getTableLocator()->get('Rutas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Rutas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\RutasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
