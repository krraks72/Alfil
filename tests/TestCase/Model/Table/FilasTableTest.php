<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilasTable Test Case
 */
class FilasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FilasTable
     */
    protected $Filas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Filas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Filas') ? [] : ['className' => FilasTable::class];
        $this->Filas = $this->getTableLocator()->get('Filas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Filas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FilasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
