<?php

use Phinx\Migration\AbstractMigration;

class CreateSubscriptionsTable extends AbstractMigration
{
    /**
     * Migrate Up
     * Create `subscriptions` table
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function up(){
        $table = $this->table('subscriptions', array('id'=>false, 'primary_key'=>'id'));
        $table->addColumn('id', 'integer', array('signed'=>false, 'identity'=>true));
        $table->addColumn('feed_url', 'string');
        $table->addColumn('feed_title', 'string',
            array('limit'=>20, 'comment'=>'contains name of table where feed details are kept')
        );
        $table->addColumn('feed_type', 'enum', array(
            'values'=>array('','rss','atom')
        ));
        $table->addColumn('last_updated', 'timestamp',
            array('default'=>'CURRENT_TIMESTAMP', 'update'=>'CURRENT_TIMESTAMP')
        );
        $table->addIndex(array('feed_url'));
        $table->save();
    }

    /**
     * Migrate Down
     * Drop `subscriptions` table
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function down(){
        $this->dropTable('subscriptions');
    }
}
