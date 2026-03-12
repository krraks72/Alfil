<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GenerosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GenerosTable Test Case
 */
class GenerosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\GenerosTable
     */
    protected $Generos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Generos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Generos') ? [] : ['className' => GenerosTable::class];
        $this->Generos = $this->getTableLocator()->get('Generos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Generos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\GenerosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
