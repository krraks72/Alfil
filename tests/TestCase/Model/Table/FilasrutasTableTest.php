<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilasrutasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilasrutasTable Test Case
 */
class FilasrutasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FilasrutasTable
     */
    protected $Filasrutas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Filasrutas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Filasrutas') ? [] : ['className' => FilasrutasTable::class];
        $this->Filasrutas = $this->getTableLocator()->get('Filasrutas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Filasrutas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FilasrutasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
