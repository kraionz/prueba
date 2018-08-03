<?php
namespace App\Modules\Module\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = module()->all();
        return view('modules::index', compact('modules'));
    }
}
