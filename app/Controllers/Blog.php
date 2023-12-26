<?php

namespace App\Controllers;
use App\Models\DatabaseGraph;
class Blog extends BaseController {
        // query req: CPU LOAD | MEMORY LOAD | PROCESSES | DISK SIZE

        public function index()
        {
            return view('index');
        }
        
        public function result()
        {
            $model = new DatabaseGraph();
            $servername = $this->request->getVar("servername");
            $queryreq = $this->request->getVar("qry");
            $data["result"] = json_encode($model->getServer($servername, $queryreq));
            return view('finalView', $data);
        }
    }
