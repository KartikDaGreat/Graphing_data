<?php

namespace App\Models;

use CodeIgniter\Model;

class DatabaseGraph extends Model
{
    protected $table = 'server_status_log';
    protected $allowedFields = ['SERVERNAME','TYPE','REPORTINGDATETIME','CPULOAD','MEMORYLOAD','PROCESSES','DISKSIZE','created_date'];
    protected $returnType = 'array';
    public function getServer($field1 = null, $field2 = null)
    {
        if ($field1 === null || $field2 === null) {
            return $this->first();
        }
        else
        {
            return $this->first();
            //return $this->select($field2.', REPORTINGDATETIME')->where('SERVERNAME', $field1)->findAll();
        }
    }
}