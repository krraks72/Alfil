<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartamentosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartamentosTable Test Case
 */
class DepartamentosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartamentosTable
     */
    protected $Departamentos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Departamentos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Departamentos') ? [] : ['className' => DepartamentosTable::class];
        $this->Departamentos = $this->getTableLocator()->get('Departamentos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Departamentos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DepartamentosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
