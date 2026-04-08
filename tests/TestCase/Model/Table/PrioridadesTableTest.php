<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrioridadesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrioridadesTable Test Case
 */
class PrioridadesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PrioridadesTable
     */
    protected $Prioridades;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Prioridades',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Prioridades') ? [] : ['className' => PrioridadesTable::class];
        $this->Prioridades = $this->getTableLocator()->get('Prioridades', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Prioridades);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PrioridadesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
