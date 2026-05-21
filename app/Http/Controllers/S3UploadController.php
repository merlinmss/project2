<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class S3UploadController extends Controller
{
    public function uploadForm()
    {
        return view('s3-upload');
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);


        if ($request->hasFile('file')) {
            try {
                $file = $request->file('file');

                // ✅ putFile() returns path string, not bool
                $path = Storage::disk('s3')->putFile('uploads', $file);

                if (!$path) {
                    return back()->withErrors(['file' => 'S3 upload failed.']);
                }

                $url = Storage::disk('s3')->url($path);

                return back()->with([
                    'success' => 'File uploaded successfully!',
                    'url' => $url,
                ]);

            } catch (\Exception $e) {
                // Shows the real AWS error (credentials, bucket, permission etc.)
                return back()->withErrors(['file' => 'Error: ' . $e->getMessage()]);
            }

            return back()->with([
                'success' => 'File uploaded successfully!',
                'url' => $url,
            ]);
        }

        return back()->withErrors(['file' => 'No file received.']);
    }
}
