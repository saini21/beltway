<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChatMessagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChatMessagesTable Test Case
 */
class ChatMessagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChatMessagesTable
     */
    public $ChatMessages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.chat_messages',
        'app.chats',
        'app.users',
        'app.chat_message_recipients'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ChatMessages') ? [] : ['className' => ChatMessagesTable::class];
        $this->ChatMessages = TableRegistry::getTableLocator()->get('ChatMessages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChatMessages);

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
