<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EspecialidadesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EspecialidadesTable Test Case
 */
class EspecialidadesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EspecialidadesTable
     */
    protected $Especialidades;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Especialidades',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Especialidades') ? [] : ['className' => EspecialidadesTable::class];
        $this->Especialidades = $this->getTableLocator()->get('Especialidades', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Especialidades);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EspecialidadesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
