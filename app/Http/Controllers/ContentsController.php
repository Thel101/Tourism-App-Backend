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
            $request->file('background')->storeAs('public/images/', $filename);
            $content['background'] = $filename;
        }
        Contents::create($content);

        return response()->json(['message' => 'New Content created successfully!']);
    }
    public function getContents()
    {
        $contents = Contents::orderBy('page_name')
        ->paginate(4);
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

            $image = Storage::get($path);
            $mimeType = Storage::mimeType($path);
            ob_get_clean();
            return response($image, 200)->header('Content-Type', $mimeType);
        } catch (\Exception $e) {
            // Log the error or return an appropriate error response
            return response('Error retrieving image: ' . $e->getMessage(), 500);
        }
    }
    public function getContent($id){
        $content = Contents::where('id', $id)->first();
        return $content;
    }
    public function editContent(Request $request){
       $content = Contents::where('id',$request->id)->first();

       $request->validate([
        'page_name' => 'required',
        'content_slots' => 'required',
        'status' => 'required',
    ]);
    $updateData = $request->all();
    $photo = $request->file('background');
    if ($photo) {
        $existingImage = $content->background;
        if(Storage::exists($existingImage)){
            Storage::delete($existingImage);
        }
        $filename = uniqid() . $photo->getClientOriginalName();
        $photo->storeAs('public/images/', $filename);
        $updateData['background'] = $filename;
    }
    else {
        // If no new image uploaded, retain the existing background image
        unset($updateData['background']); // Remove 'background' key from updateData
    }
    $content->update($updateData);
    return response()->json(['message'=>'Content Updated Successfully']);
    }
    public function deleteContent($id){
        $content = Contents::find($id);
        $content->delete();

        $image = $content->background;
        if($image){
            $path= 'public/images/'.$image;
            Storage::delete($path);
        }
        return response()->json(['message'=>'Content updated permanently']);
    }
}
