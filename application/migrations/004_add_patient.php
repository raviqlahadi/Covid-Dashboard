<?php
defined('BASEPATH') or exit('No Direct script allowed');

class Migration_add_patient extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(
            array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'patient_number' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100'
                ),
                'age' => array(
                    'type' => 'INT',
                    'constraint' => 5
                ),
                'status' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50'
                ),
                'date' => array(
                    'type' => 'DATE',
                ),
                'created_date datetime default current_timestamp',
                'updated_date datetime default current_timestamp on update current_timestamp', 

            )
        );
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('patients');
    }

    public function down()
    {
        $this->dbforge->drop_table('patients');
    }
}
