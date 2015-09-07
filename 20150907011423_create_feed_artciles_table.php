<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateFeedArtcilesTable extends AbstractMigration
{
    /**
     * Migrate Up
     * Create `feed_articles` table
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function up(){
        $table = $this->table('feed_articles', array('id'=>false, 'primary_key'=>'id'));
        $table->addColumn('id', 'integer', array('signed'=>false, 'identity'=>true));
        $table->addColumn('title', 'string', array('comment'=>'Article Title'));
        $table->addColumn('link', 'string');
        $table->addColumn('content', 'text');
        $table->addColumn('guid', 'string');
        $table->addColumn('viewed', 'integer', array('limit'=>MysqlAdapter::INT_TINY, 'default'=>0));
        $table->addColumn('marked', 'integer', array('limit'=>MysqlAdapter::INT_TINY, 'default'=>0));
        $table->addColumn('marked_date', 'datetime', array('comment'=>'Date article marked'));
        $table->addColumn('feed_id', 'integer', array('signed'=>false));
        $table->addColumn('stamp', 'timestamp', array('default'=>'CURRENT_TIMESTAMP'));
        $table->addIndex(array('marked'));
        $table->addIndex(array('feed_id', 'viewed'));
        $table->addIndex(array('feed_id', 'marked'));
        $table->addIndex(array('feed_id', 'stamp'));
        $table->addIndex(array('marked', 'stamp'));
        $table->addIndex(array('feed_id'));
        $table->addIndex(array('guid'));
        $table->save();
    }

    /**
     * Migrate Down
     * Drop `feed_articles` table
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function down(){
        $this->dropTable('feed_articles');
    }
}
