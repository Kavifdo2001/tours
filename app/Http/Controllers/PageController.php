<?php

namespace App\Http\Controllers;

use App\Models\AirTicket;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Diparture;
use App\Models\GalleryImage;
use App\Models\Inclusion;
use App\Models\Package;
use App\Models\PackageInclusion;
use App\Models\Route;
use App\Models\Transport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function userHome(){

        $countries = Category::whereNull('parent_id')->get();
        $packages = Package::where('type','default')->get();

        // Retrieve packages where the category name is "Sri Lanka"
        $sriLankanPackages = Package::where('type', 'default')
            ->whereHas('category', function ($query) {
                $query->where('category_name', 'Sri Lanka');
            })
            ->with('category')
            ->get();

        $maildivesPackages = Package::where('type', 'default')
            ->whereHas('category', function ($query) {
                $query->where('category_name', 'Maldives');
            })
            ->with('category')
            ->get();

        $makkahPackages = Package::where('type', 'default')
            ->whereHas('category', function ($query) {
                $query->where('category_name', 'Makkah');
            })
            ->with('category')
            ->get();


        $gallery = GalleryImage::all();

        $sriLankan = GalleryImage::whereHas('category', function ($query) {
            $query->where('category_name', 'Sri Lanka');
        }) ->get();

        $maldives = GalleryImage::whereHas('category', function ($query) {
            $query->where('category_name', 'Maldives');
        }) ->get();

        $makkah = GalleryImage::whereHas('category', function ($query) {
            $query->where('category_name', 'Makkah');
        }) ->get();

        $guides = User::where('type',2)->get();

        $com = Comment::all();

        return view('pages.home',compact(
            'countries',
            'packages',
            'sriLankanPackages',
            'maildivesPackages',
            'makkahPackages',
            'gallery',
            'sriLankan',
            'maldives',
            'makkah',
            'guides',
            'com',
        ));
    }

    public function packages(){

        $countries = Category::whereNull('parent_id')->get();
        $packages = Package::where('type','default')->get();

        // Retrieve packages where the category name is "Sri Lanka"
        $sriLankanPackages = Package::where('type', 'default')
            ->whereHas('category', function ($query) {
                $query->where('category_name', 'Sri Lanka');
            })
            ->with('category')
            ->get();

        $maildivesPackages = Package::where('type', 'default')
            ->whereHas('category', function ($query) {
                $query->where('category_name', 'Maldives');
            })
            ->with('category')
            ->get();

        $makkahPackages = Package::where('type', 'default')
            ->whereHas('category', function ($query) {
                $query->where('category_name', 'Makkah');
            })
            ->with('category')
            ->get();

        return view('pages.packages',compact('countries','packages','sriLankanPackages','maildivesPackages','makkahPackages'));
    }

    public function about(){
        $guides = User::where('type',2)->get();
        return view('pages.about' ,compact('guides'));
    }

    public function services(){
        return view('pages.services');
    }

    public function contact(){
        return view('pages.contact');
    }
    public function transport(){
        $vehicles = Transport::all();
        return view('pages.transport' ,compact('vehicles'));
    }

    public function gallery(){

        $gallery = GalleryImage::all();

        $sriLankan = GalleryImage::whereHas('category', function ($query) {
                $query->where('category_name', 'Sri Lanka');
            }) ->get();

        $maldives = GalleryImage::whereHas('category', function ($query) {
            $query->where('category_name', 'Maldives');
        }) ->get();

        $makkah = GalleryImage::whereHas('category', function ($query) {
            $query->where('category_name', 'Makkah');
        }) ->get();

        return view('pages.gallery',compact('gallery','sriLankan','maldives','makkah'));
    }

    public function bookings(){
        return view('pages.booking');
    }
    public function guides(){

        $guides = User::where('type',2)->get();

        return view('pages.guide',compact('guides'));
    }
    public function tour_details($id){

        $package = Package::findOrFail($id);

        return view('pages.tourDetails',compact('package'));
    }

    public function customize_tour($id)
    {

        $package = Package::with(['category', 'inclusions'])->findOrFail($id);

        $categoryInclusions = Inclusion::where('category_id', $package->category_id)->get();

        $airTickets = AirTicket::where('category_id', $package->category_id)->get();

        $routes = Route::where('category_id', $package->category_id)->get();

        // Get all departures related to the package's category
        $departures = Diparture::where('category_id', $package->category_id)->get();

        return view('pages.customizedTour', compact('package', 'routes', 'categoryInclusions', 'airTickets', 'departures'));
    }


    public function testimonials()
    {
        $com = Comment::all();

        return view('pages.testimonials',compact('com'));
    }
}
