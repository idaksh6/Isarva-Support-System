<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class UielementController
{
    //
    public function alerts(){
        return view('backend.ui-components.alerts');
    }
    public function badge(){
        return view('backend.ui-components.badge');
    }
    public function breadcrumb(){
        return view('backend.ui-components.breadcrumb');
    }
    public function buttons(){
        return view('backend.ui-components.buttons');
    }
    public function card(){
        return view('backend.ui-components.card');
    }
    public function carousel(){
        return view('backend.ui-components.carousel');
    }
    public function collapse(){
        return view('backend.ui-components.collapse');
    }
    public function dropdowns(){
        return view('backend.ui-components.dropdowns');
    }
    public function list(){
        return view('backend.ui-components.list');
    }
    public function modal(){
        return view('backend.ui-components.modal');
    }
    public function navs(){
        return view('backend.ui-components.navs');
    }
    public function navbar(){
        return view('backend.ui-components.navbar');
    }
    public function pagination(){
        return view('backend.ui-components.pagination');
    }
    public function popovers(){
        return view('backend.ui-components.popovers');
    }
    public function progress(){
        return view('backend.ui-components.progress');
    }
    public function scrollspy(){
        return view('backend.ui-components.scrollspy');
    }
    public function spinners(){
        return view('backend.ui-components.spinners');
    }
    public function toasts(){
        return view('backend.ui-components.toasts');
    }
    public function tooltips(){
        return view('backend.ui-components.tooltips');
    }
    public function index(){
        return view('backend.ui-components.index');
    }


    public function document(){
        return view('backend.document.doc');
    }


    public function changelog(){
        return view('backend.document.chang');
    }
}
