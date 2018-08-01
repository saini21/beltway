<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChatMessageRecipientsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChatMessageRecipientsTable Test Case
 */
class ChatMessageRecipientsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChatMessageRecipientsTable
     */
    public $ChatMessageRecipients;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.chat_message_recipients',
        'app.chat_messages',
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
        $config = TableRegistry::getTableLocator()->exists('ChatMessageRecipients') ? [] : ['className' => ChatMessageRecipientsTable::class];
        $this->ChatMessageRecipients = TableRegistry::getTableLocator()->get('ChatMessageRecipients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ChatMessageRecipients);

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
