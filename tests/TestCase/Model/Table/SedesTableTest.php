<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SedesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SedesTable Test Case
 */
class SedesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SedesTable
     */
    protected $Sedes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Sedes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Sedes') ? [] : ['className' => SedesTable::class];
        $this->Sedes = $this->getTableLocator()->get('Sedes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Sedes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SedesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
