<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IpssTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IpssTable Test Case
 */
class IpssTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IpssTable
     */
    protected $Ipss;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Ipss',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Ipss') ? [] : ['className' => IpssTable::class];
        $this->Ipss = $this->getTableLocator()->get('Ipss', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Ipss);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\IpssTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
