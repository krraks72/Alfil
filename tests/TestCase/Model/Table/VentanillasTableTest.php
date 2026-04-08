<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VentanillasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VentanillasTable Test Case
 */
class VentanillasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VentanillasTable
     */
    protected $Ventanillas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Ventanillas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Ventanillas') ? [] : ['className' => VentanillasTable::class];
        $this->Ventanillas = $this->getTableLocator()->get('Ventanillas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Ventanillas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VentanillasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
