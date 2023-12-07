<?php

namespace App\View\Components\layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SidebarUserinfo extends Component
{
    public $user_name, $user_role;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user_name = Auth::user()->name;
        $this->user_role = Auth::user()->role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.sidebar-userinfo');
    }
}
