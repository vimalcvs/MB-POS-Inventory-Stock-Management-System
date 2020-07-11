<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;
use File;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.language.index',[
            'languages' => Language::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        $language = new Language();
        $language->fill($request->all());
        if($request->hasFile('flag')){
            $language->flag = $request->flag->move('uploads/flag/', str_random(20) . '.' . $request->flag->extension());;
        }
        $language->save();

        if(File::exists(base_path().'/resources/lang/'.$language->iso_code)) {
            Toastr::warning('Language Already Exists', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        }else{
            $create_folder = File::makeDirectory(base_path().'/resources/lang/'.$language->iso_code);
            $base_path = base_path().'/resources/lang/master/pages.php';
            $destination_path = base_path().'/resources/lang/'.$language->iso_code.'/pages.php';
            $success = File::copy($base_path, $destination_path);
        }

        Toastr::success('Language successfully added', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->route('translate', $language->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($id == 1) {
            Toastr::warning('You Cannot update this language', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
            return redirect()->back();
        }

        return view('backend.language.edit',[
            'language' => Language::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, $id)
    {
        if ($id == 1) {
            Toastr::warning('You Cannot update this language', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
            return redirect()->back();
        }

        $language = Language::findOrFail($id);
        File::deleteDirectory(base_path().'/resources/lang/'.$language->iso_code);
        $language->fill($request->all());
        if($request->hasFile('flag')){
            File::delete($language->flag);
            $language->flag = $request->flag->move('uploads/flag/', str_random(20) . '.' . $request->flag->extension());;
        }
        $language->save();

        if(!File::exists(base_path().'/resources/lang/'.$language->iso_code)) {
           File::makeDirectory(base_path().'/resources/lang/'.$language->iso_code);
            $base_path = base_path().'/resources/lang/master/pages.php';
            $destination_path = base_path().'/resources/lang/'.$language->iso_code.'/pages.php';
             File::copy($base_path, $destination_path);
        }

        Toastr::success('Language successfully added', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->route('language.index');
    }


    public function editContent($id)
    {
        $language = Language::findOrFail($id);

        $files   = glob(resource_path('lang/' . $language->iso_code . '/*.php'));
        $language_array = [];


        foreach ($files as $file) {
            $name  = basename($file, '.php');
            $language_array[$name] = require $file;
        }

        return view('backend.language.translate',[
            'language' => Language::findOrFail($id),
            'language_array' => $language_array['pages'],

        ]);
    }

    public function updateContent(Request $request)
    {
        $language =  Language::findOrFail($request->language_id);

        $inputs = array_except($request->all(), ['_token', 'language_id']);

        $elements = '';
        foreach ($inputs as $key => $value) {
            $elements .= "'".$key."' => '".$value."',\n";
        }

        /** ====== set lan ===== */
$setArray = "<?php
return [".$elements."];";

        file_put_contents(base_path("/resources/lang/".$language->iso_code."/pages.php"), $setArray);
        /** ========= end ======== */

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1){
            Toastr::warning('You Cannot delete this language', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
            return redirect()->back();
        }

        $lang =  Language::findOrFail($id);
        File::deleteDirectory(base_path().'/resources/lang/'.$lang->iso_code);
        $lang->delete();

        Toastr::success('Language successfully deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }
}
