<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilasventanillasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilasventanillasTable Test Case
 */
class FilasventanillasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FilasventanillasTable
     */
    protected $Filasventanillas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Filasventanillas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Filasventanillas') ? [] : ['className' => FilasventanillasTable::class];
        $this->Filasventanillas = $this->getTableLocator()->get('Filasventanillas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Filasventanillas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FilasventanillasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
