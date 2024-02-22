<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ContentController extends BaseController
{
    public function contentpolicy()
    {
        return view("user/content-policy");
    }
    public function terms()
    {
        return view("user/terms");
    }
    public function privacy()
    {
        return view("user/privacy");
    }
    public function useofaskify()
    {
        return view("user/useofaskify");
    }
}
