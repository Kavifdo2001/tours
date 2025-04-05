<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    public function adminphotos()
    {

        $mainCategories = Category::whereNull('parent_id')->get();


        $photos = GalleryImage::with('category')->get();

        return view('admin.Gallery.images', compact('mainCategories', 'photos'));
    }



    public function storePhotos(Request $request)
    {

        $request->validate([
            'category_id' => 'required|exists:category,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $imageName = time() . '_' . $image->getClientOriginalName();


                $image->move(public_path('images/gallery'), $imageName);


                GalleryImage::create([
                    'category_id' => $request->category_id,
                    'images' => 'images/gallery/' . $imageName
                ]);
            }
        }



        return redirect()->route('admin.photos')->with('success', 'Images uploaded successfully');
    }


    public function deletePhoto($id)
    {
        $photo = GalleryImage::findOrFail($id);


        if (file_exists(public_path($photo->images))) {
            unlink(public_path($photo->images));
        }


        $photo->delete();

        return redirect()->route('admin.photos')->with('success', 'Image deleted successfully');
    }


    public function adminvideos()
    {

        $mainCategories = Category::whereNull('parent_id')->get();


        $videos = GalleryVideo::with('category')->get();
        // all();

        return view('admin.Gallery.videos', compact('mainCategories', 'videos'));
    }


    public function storeVideos(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'videos.*' => 'required|mimes:mp4,mov,ogg,qt|max:20000'
        ]);

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {

                $videoName = time() . '_' . $video->getClientOriginalName();


                $videoPath = $video->move(public_path('videos'), $videoName);


                GalleryVideo::create([
                    'category_id' => $request->category_id,
                    'videos' => 'videos/' . $videoName
                ]);
            }
        }


        return redirect()->route('admin.videos')->with('success', 'Videos uploaded successfully!');
    }

    public function deleteVideo($id)
    {
        $video = GalleryVideo::findOrFail($id);


        Storage::delete($video->videos);


        $video->delete();

        return redirect()->route('admin.videos')->with('success', 'Video deleted successfully!');
    }

}

