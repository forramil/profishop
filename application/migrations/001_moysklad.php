<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Moysklad extends CI_Migration 
{
    public function up()
    {
        $this->db->query("ALTER TABLE `orders` ADD COLUMN `moysklad` TINYINT(1) NOT NULL DEFAULT '0' AFTER `manager_guid`;");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `orders` DROP COLUMN `moysklad`;");
    }
}

;