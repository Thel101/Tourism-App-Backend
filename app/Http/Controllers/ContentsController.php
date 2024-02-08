<?php

namespace App\Http\Controllers;

use App\Models\Contents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentsController extends Controller
{
    public function createContent(Request $request)
    {
        $request->validate([
            'page_name' => 'required',
            'content_slots' => 'required',
            'status' => 'required',
        ]);
        $content = $request->all();
        if ($request->hasFile('background')) {
            $filename = uniqid() . $request->file('background')->getClientOriginalName();
            $path = $request->file('background')->storeAs('public/images/', $filename);
            $content['background'] = $filename;
        }
        Contents::create($content);

        return response()->json(['message' => 'New Content created successfully!', $path]);
    }
    public function getContents()
    {
        $contents = Contents::all();
        return $contents;
    }
    public function getPageContent($page)
    {
        $contents = Contents::where('page_name', $page)
            ->where('status', 'active')
            ->get();
        return $contents;
    }
    public function getImage($filename)
    {
        $path = 'public/images/' . $filename;
        try {
            $filesystem = Storage::disk('public');
            $image = Storage::get($path);
            $mimeType = Storage::mimeType($path);
            logger($image);
            return response($image, 200)->header('Content-Type', $mimeType);
        } catch (\Exception $e) {
            // Log the error or return an appropriate error response
            return response('Error retrieving image: ' . $e->getMessage(), 500);
        }
    }
}
