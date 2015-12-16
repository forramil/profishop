<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_userstatus extends CI_Migration 
{
    public function up()
    {
        $this->db->query("ALTER TABLE `users` ADD COLUMN `status` TINYINT(1) NOT NULL DEFAULT '1';");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `users` DROP COLUMN `status`;");
    }
}

;