<?php

namespace App\Modules\Theme\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * ThemeController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function index()
    {
        $themes = theme()->all();
        return view('themes::index', compact('themes'));
    }

    /**
     * @param $theme
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($theme)
    {
        $theme = Theme::get($theme);
        return view('themes::edit', compact('theme'));
    }

    /**
     * @param Request $request
     * @param $themeName
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $themeName){

        $theme = Theme::get($themeName);

        $theme->set(['admin' => (boolean)$request->input('admin')]);
        $theme->set(['active' => (boolean)$request->input('active')]);
        $theme->set(['name' => (string)$request->input('name')]);



        if ($request->hasFile('logo')) {
            $path = 'themes/'.$theme->get('theme').'/assets/img';
            $logo = $path.'/'.$theme->get('logo');
            if (file_exists($logo)){
                unlink($logo);
            }
            $name = 'logo.'.$request->logo->getClientOriginalExtension();
           $path = 'themes/'.$theme->get('theme').'/assets/img';
            request()->logo->move(public_path($path), $name);

            $theme->set(['logo' => $name]);
            //$this->logo($theme, $request);
        }

        if($theme->get('active')){
            $this->activeDesactive($theme);
        }else{
            $theme->save();
        }


        return back()->with('status', 'Theme update');
    }

    /**
     * @param $theme
     * @param $request
     */
    public function logo($theme, $request)
    {
        $name = 'logo.'.$request()->logo->getClientOriginalExtension();
        $theme->logo = $name;
        $theme->save();
    }

    /**
     * @param $theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active($theme)
    {
        $theme = Theme::get($theme);
        $theme->set(['active' => (boolean)true]);
        $this->activeDesactive($theme);
        return back()->with('status', 'Theme active select');
    }

    /**
     * @param $active
     */
    public function activeDesactive($active){

        $themes = Theme::all();

        foreach ($themes as $theme) {
            if ($theme->get('admin') == $active->get('admin')){

                if($theme->get('id') != $active->get('id')){

                    $theme->set(['active' => false]);
                    $theme->save();
                    //

                } else{

                    $active->save();
                   //

                }
            }
        }

    }
}
