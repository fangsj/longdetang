<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class UploadController extends BaseController
{
    public function upload(Request $request) {
        $files = $request->file('files');
        $kind = $request->input('kind');
        $saveFiles = [];
        foreach ($files as $file) {
            $saveFiles[] = [
                'name' => $file->getClientOriginalName(),
                'url' => $file->storePublicly("upload/$kind", 'public')
            ];
        }
        return response()->json($saveFiles);
    }
}
