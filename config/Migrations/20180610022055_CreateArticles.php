<?php

use Migrations\AbstractMigration;

class CreateArticles extends AbstractMigration {
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('articles');
        $table->addColumn('user_id', 'biginteger', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('content', 'text', [
            'default' => null,
            'null' => false,
        ]);
    
        $table->addColumn('link', 'string', [
            'default' => '',
            'limit' => 255,
            'null' => false,
        ]);
    
        $table->addColumn('link_host', 'string', [
            'default' => '',
            'limit' => 255,
            'null' => false,
        ]);
    
        $table->addColumn('link_title', 'string', [
            'default' => '',
            'limit' => 255,
            'null' => false,
        ]);
    
        $table->addColumn('link_image', 'string', [
            'default' => '',
            'limit' => 255,
            'null' => false,
        ]);
    
        $table->addColumn('link_description', 'text', [
            'default' => null,
            'null' => false,
        ]);
        
        
        $table->addColumn('like_count', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('status', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
