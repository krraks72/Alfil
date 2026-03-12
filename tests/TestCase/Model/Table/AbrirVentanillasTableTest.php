<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AbrirVentanillasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AbrirVentanillasTable Test Case
 */
class AbrirVentanillasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AbrirVentanillasTable
     */
    protected $AbrirVentanillas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.AbrirVentanillas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AbrirVentanillas') ? [] : ['className' => AbrirVentanillasTable::class];
        $this->AbrirVentanillas = $this->getTableLocator()->get('AbrirVentanillas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AbrirVentanillas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AbrirVentanillasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
