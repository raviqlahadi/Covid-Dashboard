<?php
defined('BASEPATH') or exit('No Direct script allowed');

class Migration_add_desc_to_group extends CI_Migration
{
    public function up()
    {

        $field = array(
            'group_name' => array(
                'name' => 'name',
                'type' => 'VARCHAR',
                'constraint' => 200,
            )
        );

        $this->dbforge->modify_column('groups', $field);
        $fields = array(
            'description' => array('type' => 'TEXT')
        );
        $this->dbforge->add_column('groups', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_table('groups');
    }
}
