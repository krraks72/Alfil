<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalasTable Test Case
 */
class SalasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SalasTable
     */
    protected $Salas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Salas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Salas') ? [] : ['className' => SalasTable::class];
        $this->Salas = $this->getTableLocator()->get('Salas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Salas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SalasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
