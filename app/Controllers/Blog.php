<?php

namespace App\Controllers;
use App\Models\DatabaseGraph;
class Blog extends BaseController {
        protected $retType = "CPULOAD";
        // CPU LOAD | MEMORY LOAD | PROCESSES | DISK SIZE
        public function index()
        {
            return view('index');
        }
        
        public function result()
        {
            form(;;)
            $model = new DatabaseGraph();
            $data["result"] = $model->getServer('cl1-multi.enovasolutions.com');
            //$data['returnType'] = $GLOBALS['retType'];
            return view('finalView', $data);
        }
    }
