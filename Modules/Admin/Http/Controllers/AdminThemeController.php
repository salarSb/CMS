<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Admin\Traits\AdminUtil;
use ZipArchive;

class AdminThemeController extends Controller
{
    use AdminUtil;

    public function index()
    {
        return view('admin::themes.index');
    }

    public function data(Request $request)
    {
        return response()->json(Theme::generateDataTable($request));
    }

    public function activate(Theme $theme)
    {
        $themes = Theme::all();
        foreach ($themes as $oldTheme) {
            $oldTheme->active = 0;
            $oldTheme->save();
        }
        $theme->active = 1;
        $theme->save();
        return redirect(route('themes.index'));
    }

    public function create()
    {
        return view('admin::themes.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        if (!request()->filled('slug')) {
            $inputs['slug'] = Str::slug($request->name);
        }
        $fileSize = $this->formatBytes($request->file('file')->getSize());
        $date = Carbon::now();
        $themeImageDirectoryPath = '/images/themes' . "/$date->year/";
        $themeImageName = $date->timestamp . '_' . pathinfo($inputs['file']->getClientOriginalName(), PATHINFO_FILENAME) . '.png';
        $filePath = $request->file('file')->store('themes');
        $zipFile = new ZipArchive();
        if ($zipFile->open($inputs['file']) == true) {

            //store the theme image to storage
            $stringImage = $zipFile->getFromName('screenshot.png');
            $image = imagecreatefromstring($stringImage);
            if (!Storage::disk('public')->exists($themeImageDirectoryPath)) {
                Storage::disk('public')->makeDirectory($themeImageDirectoryPath);
            }
            $themeImageFinalPath = 'app/public' . $themeImageDirectoryPath . $themeImageName;
            imagepng($image, storage_path($themeImageFinalPath));

            //extract all files to client_path
            $themePath = env('CLIENT_PATH') . '/src/themes/' . $inputs['slug'];
            $zipFile->extractTo($themePath);

            $zipFile->close();

            //exec npm run build
            exec('cd ' . env('CLIENT_PATH') . ' && npm run build');
        } else {
            return redirect()->back()->withErrors(['file' => 'فقط فایل ZIP مجاز است']);
        }
        $inputs['images'] = 'images/themes/' . $date->year . '/' . $themeImageName;
        $inputs['file'] = $filePath;
        $inputs['size'] = $fileSize;
        Theme::create($inputs);
        return redirect()->route('themes.index');
    }

    public function show(Theme $theme)
    {
        //
    }

    public function edit(Theme $theme)
    {
        //
    }

    public function update(Request $request, Theme $theme)
    {
        //
    }

    public function destroy(Theme $theme)
    {
        //
    }
}
