<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChatMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChatMembersTable Test Case
 */
class ChatMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChatMembersTable
     */
    public $ChatMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.chat_members',
        'app.chats',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChatMembers') ? [] : ['className' => ChatMembersTable::class];
        $this->ChatMembers = TableRegistry::getTableLocator()->get('ChatMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChatMembers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
