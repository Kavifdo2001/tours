<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Diparture;
use App\Models\Route;
use App\Models\Inclusion;
use App\Models\AirTicket;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Photos;
use App\Models\Transport;
use App\Models\Videos;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function admincategory()
    {
        $categories = Category::where('parent_id', null)->get();
        return view('admin.admin_category', compact('categories'));
    }

    public function storecategory(Request $request)
   {
    $request->validate([
        'category_name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);
    // var_dump( $request->file('image')); die();
    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('images/categories'), $imageName);


    Category::create([
        'category_name' => $request->category_name,
        'parent_id' => $request->parent_id ?? null,
        'image' => 'images/categories/' . $imageName,
    ]);

    return redirect()->route('admin.category')->with('success', 'Category added successfully!');
   }


    public function editCategory($id)
   {
    $category = Category::findOrFail($id);
    return view('admin.edit_category', compact('category'));
   }


   public function updateCategory(Request $request, $id)
   {
    $request->validate([
        'category_name' => 'required|string|max:255',
         'image' => 'image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $category = Category::findOrFail($id);
    $category->category_name = $request->category_name;

    if ($request->hasFile('image')) {

        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/categories'), $imageName);
        $category->image = 'images/categories/' . $imageName;
    }

    $category->save();

    return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
   }

   public function deleteCategory($id)
   {
      $category = Category::findOrFail($id);
      $this->deleteSubCategories($category);
      $category->delete();

      return redirect()->route('admin.category')->with('success', 'Category deleted successfully.');
    }
    protected function deleteSubCategories(Category $category)
    {
        foreach ($category->subCategories as $subCategory) {
            $this->deleteSubCategories($subCategory);
            $subCategory->delete();
        }
    }




// sub category controllers

public function subCategory($id)
 {
    $mainCategory = Category::findOrFail($id);
    $subCategories = Category::where('parent_id', $id)->get();
    return view('admin.sub_category', compact('mainCategory', 'subCategories'));
 }

public function storeSubCategory(Request $request)
 {
    $request->validate([
        'category_name' => 'required|string|max:255',
        'subcategory_name' => 'required|string|max:255',
    ]);

    Category::create([
        'category_name' => $request->subcategory_name,
        'parent_id' => $request->category_id,
    ]);

    return redirect()->route('admin.subcategory', ['id' => $request->category_id])->with('success', 'Subcategory added successfully!');
 }

public function editSubCategory($id)
 {
    $subCategory = Category::findOrFail($id);
    $mainCategory = Category::findOrFail($subCategory->parent_id);
    return view('admin.edit_subcategory', compact('subCategory', 'mainCategory'));
 }

public function updateSubCategory(Request $request, $id)
{
    $request->validate([
        'category_name' => 'required|string|max:255',
    ]);

    $subCategory = Category::findOrFail($id);
    $subCategory->category_name = $request->category_name;
    $subCategory->save();

    return redirect()->route('admin.subcategory', ['id' => $subCategory->parent_id])->with('success', 'Subcategory updated successfully.');
 }

public function deleteSubCategory($id)
{
    $subCategory = Category::findOrFail($id);
    $parentId = $subCategory->parent_id;
    $subCategory->delete();

    return redirect()->route('admin.subcategory', ['id' => $parentId])->with('success', 'Subcategory deleted successfully.');
}



// departures

public function departures(){

    $mainCategories = Category::whereNull('parent_id')->orWhere('parent_id', null)->get();

    $departures = Diparture::with('category')->orderBy('created_at', 'desc')->get();

    return view('admin.departures', compact('mainCategories', 'departures'));
}

public function storeDeparture(Request $request)
{
    $request->validate([
        'mainctg_id' => 'required',
        'name' => 'required|string|max:255',
    ]);


    Diparture::create([
        'category_id' => $request->mainctg_id,
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'Departure saved successfully!');
}

public function fetchSubCategories(Request $request)
{

    $subCategories = Category::where('parent_id', $request->parent_id)->get();
    return response()->json(['subCategories' => $subCategories]);
}

public function editdeparture($id)
{
    $departure = Diparture::find($id);
    if (!$departure) {
        return redirect()->back()->with('error', 'Departure not found!');
    }


    $mainCategories = Category::whereNull('parent_id')->orWhere('parent_id', null)->get();

    return view('admin.edit_departures', compact('departure', 'mainCategories'));
}

public function updatedeparture(Request $request, $id)
{

    $request->validate([
        'mainctg_id' => 'required',
        'name' => 'required|string|max:255',
    ]);


    $departure = Diparture::find($id);

    if (!$departure) {
        return redirect()->back()->with('error', 'Departure not found!');
    }


    $departure->category_id = $request->mainctg_id;
    $departure->name = $request->name;
    $departure->save();

    return redirect()->route('admin.departures')->with('success', 'Departure updated successfully!');
}
public function destroydeparture($id)
{

    $departure = Diparture::find($id);

    if (!$departure) {
        return redirect()->back()->with('error', 'Departure not found!');
    }


    $departure->delete();

    return redirect()->route('admin.departures')->with('success', 'Departure deleted successfully!');
}






// routes
public function routes()
{
    $mainCategories = Category::whereNull('parent_id')->orWhere('parent_id', null)->get();
    $routes = Route::with('category')->orderBy('created_at', 'desc')->get();

    return view('admin.routes', compact('mainCategories', 'routes'));
}

public function storeRoutes(Request $request)
{
    $request->validate([
        'mainctg_id' => 'required',
        'name' => 'required|string|max:255',
    ]);

    Route::create([
        'category_id' => $request->mainctg_id,
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'Route saved successfully!');
}

public function editRoute($id)
{
    $route = Route::find($id);

    if (!$route) {
        return redirect()->back()->with('error', 'Route not found!');
    }

    $mainCategories = Category::whereNull('parent_id')->orWhere('parent_id', null)->get();

    return view('admin.edit_route', compact('route', 'mainCategories')); // Ensure you create this view
}

public function updateRoute(Request $request, $id)
{
    $request->validate([
        'mainctg_id' => 'required',
        'name' => 'required|string|max:255',
    ]);

    $route = Route::find($id);

    if (!$route) {
        return redirect()->back()->with('error', 'Route not found!');
    }

    $route->category_id = $request->mainctg_id;
    $route->name = $request->name;
    $route->save();

    return redirect()->route('admin.routes')->with('success', 'Route updated successfully!');
}

public function destroyRoute($id)
{
    $route = Route::find($id);

    if (!$route) {
        return redirect()->back()->with('error', 'Route not found!');
    }

    $route->delete();

    return redirect()->route('admin.routes')->with('success', 'Route deleted successfully!');
}







// inclusions
public function inclusions(){
    $mainCategories = Category::whereNull('parent_id')->orWhere('parent_id', null)->get();
    $inclusions = Inclusion::with('category')->orderBy('created_at', 'desc')->get();


    return view('admin.inclusions', compact('mainCategories', 'inclusions'));
}



public function storeInclusions(Request $request)
{
    $request->validate([
        'mainctg_id' => 'required',
        'name' => 'required|string|max:255',
    ]);

    Inclusion::create([
        'category_id' => $request->mainctg_id,
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'Inclusion saved successfully!');
}

public function editInclusions($id)
{
    $inclusions = Inclusion::find($id);

    if (!$inclusions) {
        return redirect()->back()->with('error', 'Inclusions not found!');
    }

    $mainCategories = Category::whereNull('parent_id')->orWhere('parent_id', null)->get();

    return view('admin.edit_inclusion', compact('inclusions', 'mainCategories'));
}

public function updateInclusions(Request $request, $id)
{
    $request->validate([
        'mainctg_id' => 'required',
        'name' => 'required|string|max:255',
    ]);

    $inclusions = Inclusion::find($id);

    if (!$inclusions) {
        return redirect()->back()->with('error', 'Inclusions not found!');
    }

    $inclusions->category_id = $request->mainctg_id;
    $inclusions->name = $request->name;
    $inclusions->save();

    return redirect()->route('admin.inclusions')->with('success', 'Inclusions updated successfully!');
}

public function destroyinclusions($id)
{
    $inclusions = Inclusion::find($id);

    if (!$inclusions) {
        return redirect()->back()->with('error', 'Inclusion not found!');
    }

    $inclusions->delete();

    return redirect()->route('admin.inclusions')->with('success', 'Inclusion deleted successfully!');
}




// airtickets
public function airtickets(){

    $mainCategories = Category::whereNull('parent_id')->orWhere('parent_id', null)->get();
    $airtickets = AirTicket::with('category')->orderBy('created_at', 'desc')->get();

    return view('admin.airtickets', compact('mainCategories', 'airtickets'));
}


public function storeAirtickets(Request $request)
{
    $request->validate([
        'mainctg_id' => 'required',
        'name' => 'required|string|max:255',
    ]);

    AirTicket::create([
        'category_id' => $request->mainctg_id,
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'Airtickets saved successfully!');
}

public function editAirtickets($id)
{
    $airtickets =  AirTicket::find($id);

    if (!$airtickets) {
        return redirect()->back()->with('error', 'Airtickets not found!');
    }

    $mainCategories = Category::whereNull('parent_id')->orWhere('parent_id', null)->get();

    return view('admin.edit_airticket', compact('airtickets', 'mainCategories'));
}

public function updateAirtickets(Request $request, $id)
{
    $request->validate([
        'mainctg_id' => 'required',
        'name' => 'required|string|max:255',
    ]);

    $airtickets = AirTicket::find($id);

    if (!$airtickets) {
        return redirect()->back()->with('error', 'Airtickets not found!');
    }

    $airtickets->category_id = $request->mainctg_id;
    $airtickets->name = $request->name;
    $airtickets->save();

    return redirect()->route('admin.airtickets')->with('success', 'Airtickets updated successfully!');
}

public function destroyAirtickets($id)
{
    $irtickets = AirTicket::find($id);

    if (!$irtickets) {
        return redirect()->back()->with('error', 'Airticket not found!');
    }

    $irtickets->delete();

    return redirect()->route('admin.airtickets')->with('success', 'Air ticket deleted successfully!');
}


// tour default packcage

    public function admindefaulttour(){
        $mainCategories = Category::whereNull('parent_id')->get();
        $guides = User::where('type', 2)->get();
        $tourPackages = Package::with(['category', 'subCategory', 'guide'])
            ->orWhere('type','default')->get();

        return view('admin.package', compact('mainCategories' , 'guides', 'tourPackages'));
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = Category::where('parent_id', $request->category_id)->get();
        return response()->json($subCategories);
    }

    public function getDepartures(Request $request)
    {
        $departures = Diparture::where('category_id', $request->category_id)->get();
        return response()->json($departures);
    }

    public function getRoutes(Request $request)
    {
        $routes = Route::where('category_id', $request->category_id)->get();
        return response()->json($routes);
    }

    public function getInclusions(Request $request)
    {
        $inclusions = Inclusion::where('category_id', $request->category_id)->get();
        return response()->json($inclusions);
    }

    public function getAirTickets(Request $request)
    {
        $airTickets = AirTicket::where('category_id', $request->category_id)->get();
        return response()->json($airTickets);
    }

    public function getGuides(Request $request)
    {
        $mainCategory = Category::find($request->category_id);
        $guides = User::where('type', 2)
            ->where('category', $mainCategory->category_name)
            ->get();
        return response()->json($guides);
    }

    public function getFormattedAmountAttribute()
    {
        $symbol = $this->currency === 'USD' ? '$' : 'Rs';
        return $symbol . ' ' . number_format($this->amount, 2);
    }

    public function storedefault_tour(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subctg_id' => 'required',
            // 'departure_id' => 'required',
            // 'route_id' => 'required',
            // 'inclusion_id' => 'required',
            // 'route_ids' => 'required|array',
            // 'inclusion_ids' => 'required|array',
            // 'air_ticket_id' => 'required',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|in:USD,LKR',
            'days' => 'required|integer',
            // 'guide_id' => 'required',
            'mainImage' => 'required|image',
            'otherImages.*' => 'image',
            // 'document' => 'nullable|mimes:pdf,doc,docx',
            // 'videos.' => 'nullable|mimetypes:video/',
        ]);
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        // $currencySymbol = $request->currency === 'USD' ? '$' : 'Rs';
        // $amountWithCurrency = $currencySymbol . $request->amount;

        $package = Package::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subctg_id,
            'air_ticket_id' => $request->air_ticket_id,
            'departure_id' => $request->departure_id,
            // 'route_id' => $request->route_id,
            // 'inclusion_id' => $request->inclusion_id,
            'amount' => $amount,
            'currency' => $currency,
            'no_of_days' => $request->days,
            'guide_id' => $request->guide_id,
            'description' => $request->description,
            'tour_name' => $request->tour_name,
        ]);
        $package->routes()->sync($request->route_ids);
        $package->inclusions()->sync($request->inclusion_ids);


        // Handle main image
        if ($request->hasFile('mainImage')) {
            $mainImage = $request->file('mainImage');
            $mainImageName = time() . '.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('images/package/photo'), $mainImageName);
            $mainImagePath = 'images/package/photo/' . $mainImageName;
        }

        // Handle other images
        $otherImagesPaths = [];
        if ($request->hasFile('otherImages')) {
            foreach ($request->file('otherImages') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images/package/photo'), $imageName);
                $otherImagesPaths[] = 'images/package/photo/' . $imageName;
            }
        }

        // Save images to the Photos table
        Photos::create([
            'package_id' => $package->id,
            'main_image' => $mainImagePath,
            'other_images' => implode(',', $otherImagesPaths),
        ]);

        // Handle document
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = time() . '.' . $document->getClientOriginalExtension();
            $document->move(public_path('images/package/pdf'), $documentName);
            $documentPath = 'images/package/pdf/' . $documentName;
            $package->update(['pdf_document' => $documentPath]);
        }

        // Handle videos
        // if ($request->hasFile('videos')) {
        //     foreach ($request->file('videos') as $video) {
        //         $videoName = time() . '-' . $video->getClientOriginalName();
        //         $video->move(public_path('images/package/video'), $videoName);
        //         $videoPath = 'images/package/video/' . $videoName;

        //         Videos::create([
        //             'package_id' => $package->id,
        //             'video' => $videoPath,
        //         ]);
        //     }
        // }

        return redirect()->route('admin.default_tour')->with('success', 'Package created successfully!');
    }





    public function viewTourPackage($id)
    {
        $package = Package::with([
            'category',
            'subCategory',
            'departure',
            'routes',
            'inclusions',
            'airTicket',
            'guide',
            'photos',
            // 'videos'
        ])->findOrFail($id);

        return view('admin.view_tour_package', compact('package'));
    }



    public function editTourPackage($id)
    {
        $package = Package::findOrFail($id);
        $mainCategories = Category::all();
        $subCategories = Category::where('parent_id', $package->category_id)->get();
        $departures = Diparture::where('category_id', $package->category_id)->get();
        $routes = Route::where('category_id', $package->category_id)->get();
        $inclusions = Inclusion::where('category_id', $package->category_id)->get();
        $airtickets = AirTicket::where('category_id', $package->category_id)->get();
        $guides = User::where('type', 2)
            ->where('category', $package->category->category_name)
            ->get();

        $otherImages = json_decode($package->additional_images, true) ?? [];

        return view('admin.edit_tour_package', compact('package', 'mainCategories', 'subCategories', 'departures', 'routes', 'inclusions', 'airtickets', 'guides', 'otherImages'));
    }

    public function getSubCatego($category_id)
    {
        $subCategories = Category::where('parent_id', $category_id)->get();
        return response()->json($subCategories);
    }

    public function getDepartu($category_id)
    {
        $departures = Departure::where('category_id', $category_id)->get();
        return response()->json($departures);
    }

    public function getRout($category_id)
    {
        $routes = Route::where('category_id', $category_id)->get();
        return response()->json($routes);
    }

    public function getInclus($category_id)
    {
        $inclusions = Inclusion::where('category_id', $category_id)->get();
        return response()->json($inclusions);
    }

    public function getAir($category_id)
    {
        $airtickets = AirTicket::where('category_id', $category_id)->get();
        return response()->json($airtickets);

    }
    public function getGuide($category_id)
    {
        $mainCategory = Category::find($category_id);
        $guides = User::where('type', 2)
            ->where('category', $mainCategory->category_name)
            ->get();
        return response()->json($guides);
    }




    public function updateTourPackage(Request $request, $id)
    {
        $request->validate([
            'subctg_id' => 'required|exists:category,id',
            'air_ticket_id' => 'required|exists:air_tickets,id',
            'departure_id' => 'required|exists:dipartures,id',
            'amount' => 'required|numeric',
            'currency' => 'required|in:USD,LKR',
            'days' => 'required|integer',
            'guide_id' => 'required|exists:users,id',
            'mainImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'otherImages.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document' => 'nullable|mimes:pdf,doc,docx|max:2048',
            // 'videos.' => 'nullable|mimetypes:video/|max:20480',
            'route_ids' => 'required|array',
            'route_ids.*' => 'exists:routes,id',
            'inclusion_ids' => 'required|array',
            'inclusion_ids.*' => 'exists:inclusions,id',
        ]);

        $package = Package::findOrFail($id);

        $package->subcategory_id = $request->subctg_id;
        $package->air_ticket_id = $request->air_ticket_id;
        $package->departure_id = $request->departure_id;
        $package->amount = $request->amount;
        $package->currency = $request->currency;
        $package->no_of_days = $request->days;
        $package->guide_id = $request->guide_id;
        $package->description = $request->description;

        // Handle main image upload
        if ($request->hasFile('mainImage')) {
            $mainImage = $request->file('mainImage');
            $mainImageName = time() . '_main.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('images/package/photo'), $mainImageName);

            // Delete old main image if exists
            if ($package->photos && $package->photos->main_image) {
                $oldMainImagePath = public_path($package->photos->main_image);
                if (file_exists($oldMainImagePath)) {
                    unlink($oldMainImagePath);
                }
            }

            // Update or create photos record
            $package->photos()->updateOrCreate(
                ['package_id' => $package->id],
                ['main_image' => 'images/package/photo/' . $mainImageName]
            );
        }

        // Handle other images upload
        if ($request->hasFile('otherImages')) {
            $otherImagePaths = [];
            foreach ($request->file('otherImages') as $key => $image) {
                $imageName = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/package/photo'), $imageName);
                $otherImagePaths[] = 'images/package/photo/' . $imageName;
            }

            // Delete old other images if exist
            if ($package->photos && $package->photos->other_images) {
                $oldImages = explode(',', $package->photos->other_images);
                foreach ($oldImages as $oldImage) {
                    $oldImagePath = public_path($oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }

            // Update or create photos record
            $package->photos()->updateOrCreate(
                ['package_id' => $package->id],
                ['other_images' => implode(',', $otherImagePaths)]
            );
        }

        // Handle document upload
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = time() . '.' . $document->getClientOriginalExtension();
            $document->move(public_path('images/package/pdf'), $documentName);

            // Delete old document if exists
            if ($package->pdf_document) {
                $oldDocumentPath = public_path($package->pdf_document);
                if (file_exists($oldDocumentPath)) {
                    unlink($oldDocumentPath);
                }
            }

            $package->pdf_document = 'images/package/pdf/' . $documentName;
        }

        // // Handle videos upload
        // if ($request->hasFile('videos')) {
        //     foreach ($request->file('videos') as $key => $video) {
        //         $videoName = time() . '_' . $key . '.' . $video->getClientOriginalExtension();
        //         $video->move(public_path('images/package/video'), $videoName);



        //         $package->videos()->create(['video' => 'images/package/video/' . $videoName]);
        //         //  Delete old videos if exist
        //     if ($package->videos) {
        //         foreach ($package->videos as $oldVideo) {
        //             $oldVideoPath = public_path($oldVideo->video);
        //             if (file_exists($oldVideoPath)) {
        //                 unlink($oldVideoPath);
        //             }
        //             $oldVideo->delete();
        //         }
        //     }
        //    }
        // }

        $package->save();

        // Update routes and inclusions
        $package->routes()->sync($request->route_ids);
        $package->inclusions()->sync($request->inclusion_ids);

        return redirect()->route('admin.default_tour')->with('success', 'Tour package updated successfully');
    }


    public function deleteTourPackage($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->route('admin.default_tour')->with('success', 'Tour package deleted successfully');
    }

// Guide
    public function adminGuide(){

        $guides = User::where('type', '2')->get();
        return view('admin.guide', compact('guides'));
    }



    public function guideRegister()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.guide_register', compact('categories'));
    }

    public function storeGuide(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'contact' => 'required|string|max:20',
            'address' => 'required|string',
            'description' => 'required|string',
            'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|exists:category,id',
        ]);


        $imagePath = null;
        if ($request->hasFile('profileImage')) {
            $image = $request->file('profileImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/guide_profile'), $imageName);
            $imagePath = 'images/guide_profile/' . $imageName;
        }

        $category = Category::findOrFail($request->category);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
            'address' => $request->address,
            'description' => $request->description,
            'profileImage' => $imagePath,
            'type' => 'guide',
            'category' => $category->category_name,
        ]);



        return redirect()->route('admin.create_guide')->with('success', 'Guide registered successfully');
    }

    public function viewGuide($id)
    {
        $guide = User::find($id);
        return view('admin.view_guide', compact('guide'));
    }

    public function changePassword(Request $request, $id)
    {
        $guide = User::find($id);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->current_password, $guide->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $guide->password = Hash::make($request->new_password);
        $guide->save();

        return redirect()->route('admin.view_guide', $guide->id)->with('success', 'Password changed successfully');
    }




    public function editGuide($id)
    {
        $guide = User::find($id);
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.edit_guide', compact('guide', 'categories'));
    }


    public function updateGuide(Request $request, $id)
    {
        $guide = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|exists:category,id',
        ]);

        $guide->name = $request->name;
        $guide->address = $request->address;
        $guide->contact = $request->contact;
        $guide->description = $request->description;

        $category = Category::findOrFail($request->category);
        $guide->category = $category->category_name;

        if ($request->hasFile('profileImage')) {
            // Delete old image if it exists
            if ($guide->profileImage && file_exists(public_path($guide->profileImage))) {
                unlink(public_path($guide->profileImage));
            }

            // Store new image
            $image = $request->file('profileImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/guide_profile'), $imageName);
            $imagePath = 'images/guide_profile/' . $imageName;

            $guide->profileImage = $imagePath;
        }

        $guide->save();

        return redirect()->route('admin.view_guide', $guide->id)->with('success', 'Guide information updated successfully');
    }


    public function destroyGuide($id)
    {
        $guide = User::find($id);
        $guide->delete();
        return redirect()->route('admin.guide')->with('success', 'Guide deleted successfully');
    }



// Users
    public function users(){
        $users = User::where('type', 0)->orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function user_destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('users')->with('error', 'Failed to delete user.');
        }
    }

    //Customized Tours

    public function admin_customized_tours()
    {
        $tours = Package::where('type','custom')
            ->where('status','pending')->get();
        return view('admin.adminTours.customizedTours',compact('tours'));
    }

    public function view_custom_tour($id)
    {
        $tour = Package::findOrFail($id);

        return view('admin.adminTours.viewCustomTour',compact('tour'));
    }

    public function confirm_tour(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        $tour = Package::find($id);

        $tour->amount = $request->amount;
        $tour->status = 'confirmed';

        $tour->save();

        return redirect()->route('customized.tours')->with('success', 'Tour Confirmed Successfully');

    }

    public function adminBooking()
    {
        $bookings = Booking::all();

        return view('admin.adminTours.adminTourBookings',compact('bookings'));
    }

    public function viewBookings($id)
    {
        $tour = Booking::find($id);

        return view('admin.adminTours.adminViewBookings',compact('tour'));
    }


    //admin
    public function admin_view()
    {
        $admins = User::where('type' , 1)->get();

        return view('admin.admin-view.admin-index' ,compact('admins'));
    }

    public function admin_destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Failed to delete user.');
        }
    }

    public function editAdmin($id)
    {
        $guide = User::find($id);
        return view('admin.admin-view.edit-admin', compact('guide'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $guide = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $guide->name = $request->name;
        $guide->address = $request->address;
        $guide->contact = $request->contact;


        $guide->save();

        return redirect()->route('admin.index', $guide->id)->with('success', 'Admin information updated successfully');
    }

    public function AdminRegister()
    {
        return view('admin.admin-view.create-admin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'contact' => 'required|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact' => $request->contact,
            'type' => 'admin'
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin registered successfully');
    }

    public function adminChangePassword(Request $request, $id)
    {

        $guide = User::find($id);

        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $guide->password = Hash::make($request->password);
        $guide->save();

        return redirect()->route('admin.index', $guide->id)->with('success', 'Password changed successfully');
    }

    public function transport(){

        $transport = Transport::all();
        return view('admin.transport.index', compact('transport'));
    }

    public function add_transport(){

        return view('admin.transport.add');
    }

    public function store_transport(Request $request){

        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/transport'), $imageName);
            $imagePath = 'images/transport/' . $imageName;
        }

        $user = Transport::create([
            'name' => $request->name,
            'model' => $request->model,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.transport')->with('success', 'Vehicle Added successfully');
    }


    public function edit_transport($id){

        $category = Transport::findOrFail($id);
       

        return view('admin.transport.edit', compact('category'));
    }

    public function update_transport(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);
    
        $category = Transport::findOrFail($id);
    
        // Debugging: Check if the request data is being received
        // dd($request->all());
    
        $category->name = $request->name;
        $category->model = $request->model;
        $category->price = $request->price;
    
        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/transport'), $imageName);
            $category->image = 'images/transport/' . $imageName;
        }
    
        $category->save();
    
        return redirect()->route('admin.transport')->with('success', 'Vehicle updated successfully.');
    }

    // AdminController.php
    public function destroy_transport($id)
    {
        // Find the transport entry by ID
        $transport = Transport::findOrFail($id);

        // Delete the associated image file if it exists
        if ($transport->image && file_exists(public_path($transport->image))) {
            unlink(public_path($transport->image));
        }

        // Delete the transport entry from the database
        $transport->delete();

        // Redirect back with a success message
        return redirect()->route('admin.transport')->with('success', 'Vehicle deleted successfully.');
    }

}
