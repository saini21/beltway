<?php

use Migrations\AbstractMigration;

class CreateUserDetails extends AbstractMigration {
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('user_details');
        $table->addColumn('user_id', 'biginteger', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->addColumn('are_you_a_registered_voter', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('did_you_vote_in_last_elections', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('do_you_think_the_media_is_biased', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('are_politicians_listening_to_the_american_public', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('watch_the_news', 'boolean', [
            'default' => false
        ]);
        $table->addColumn('attend_rallies', 'boolean', [
            'default' => false
        ]);
        $table->addColumn('write_to_local_leaders', 'boolean', [
            'default' => false
        ]);
        $table->addColumn('active_on_social_media', 'boolean', [
            'default' => false
        ]);
        $table->addColumn('all_the_above', 'boolean', [
            'default' => false
        ]);
        $table->addColumn('none_of_the_above', 'boolean', [
            'default' => false
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
