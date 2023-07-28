<?php

namespace App\Http\Controllers\Base;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use App\Models\User;



class BaseController extends Controller
{
    public $deleted = 'deleted';
    public $created = 'created';
    public $updated = 'updated';

    public function __construct()
    {
        $this->Log = new Log;
        $this->User = new User;
    }
}
