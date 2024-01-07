<?php

namespace Modules\TaskManagmentSystem\app\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => ['nullable', 'mimes:pdf'],
        ]);
        $originalFilename = $request->file->getClientOriginalName();
        $newFilename = 'file_' . time() . '_' . rand(1000, 9999) . '.' . $request->file->getClientOriginalExtension();

        $request->file->move(public_path('temp'), $newFilename);

        return response()->json([
            'file' => $newFilename
        ]);
    }
}
