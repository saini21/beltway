<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticleCommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArticleCommentsTable Test Case
 */
class ArticleCommentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArticleCommentsTable
     */
    public $ArticleComments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.article_comments',
        'app.articles',
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
        $config = TableRegistry::getTableLocator()->exists('ArticleComments') ? [] : ['className' => ArticleCommentsTable::class];
        $this->ArticleComments = TableRegistry::getTableLocator()->get('ArticleComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArticleComments);

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
