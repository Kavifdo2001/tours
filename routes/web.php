<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CustomizedTourController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [PageController::class, 'userHome'])->name('home');
Route::get('/', [PageController::class, 'userHome'])->name('home');
Route::get('/packages', [PageController::class, 'packages'])->name('packages');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/booking', [PageController::class, 'bookings'])->name('bookings');
Route::get('/guides', [PageController::class, 'guides'])->name('guide');
Route::get('/client-feedback', [PageController::class, 'testimonials'])->name('testimonial');
Route::get('/tour-details/{id}', [PageController::class, 'tour_details'])->name('tourDetails');
Route::get('/customize-tour/{id}', [PageController::class, 'customize_tour'])->name('customizeTour');
Route::post('/store-customized-tour',[CustomizedTourController::class, 'store_custom_tour'])->name('storeCustomizedTour');
Route::post('/user/contact-us', [UserController::class, 'send_email'])->name('user.mail');
Route::get('/transport', [PageController::class, 'transport'])->name('transport');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register_user', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/registration', [RegisterController::class, 'register'])->name('registeration');

Route::get('auth/google', [GoogleController::class, 'googlePage'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'googleCallBack'])->name('google.callback');



 //User Access
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/profile', [UserController::class, 'user_profile'])->name('profile')->middleware('auth');
    Route::get('/profile/edit', [UserController::class, 'user_profile_edit'])->name('profile.edit')->middleware('auth');
    Route::post('/profile/update', [UserController::class, 'user_profile_update'])->name('profile.update')->middleware('auth');
    Route::post('profile/change-password', [UserController::class, 'user_change_Password'])->name('profile.changePassword')->middleware('auth');
    Route::get('/user-tours/{id}', [UserController::class, 'user_tours'])->name('userTours')->middleware('auth');
    Route::post('/user/book-tours/{id}', [UserController::class, 'book_tour'])->name('bookTours')->middleware('auth');
    Route::get('/user/booked-tours/{id}', [UserController::class, 'view_booked_tours'])->name('booked.tours')->middleware('auth');
    Route::post('/user/comment', [UserController::class, 'user_comment'])->name('user.comment')->middleware('auth');



});

// Admin dashboard

Auth::routes();

Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

// category routes

    Route::get('/admin/category', [AdminController::class, 'admincategory'])->name('admin.category');
    Route::post('/admin/category', [AdminController::class, 'storecategory'])->name('store.category');
    Route::get('/admin/category/edit/{id}', [AdminController::class, 'editCategory'])->name('edit.category');
    Route::post('/admin/category/update/{id}', [AdminController::class, 'updateCategory'])->name('update.category');
    Route::get('/admin/category/delete/{id}', [AdminController::class, 'deleteCategory'])->name('delete.category');


    // sub category routes

    Route::get('/admin/category/subcategory/{id}', [AdminController::class, 'subCategory'])->name('admin.subcategory');
    Route::post('/admin/category/subcategory', [AdminController::class, 'storeSubCategory'])->name('store.subcategory');
    Route::get('/admin/category/subcategory/edit/{id}', [AdminController::class, 'editSubCategory'])->name('edit.subcategory');
    Route::post('/admin/category/subcategory/update/{id}', [AdminController::class, 'updateSubCategory'])->name('update.subcategory');
    Route::get('/admin/category/subcategory/delete/{id}', [AdminController::class, 'deleteSubCategory'])->name('delete.subcategory');

    //dipartures

    Route::get('/admin/departures', [AdminController::class, 'departures'])->name('admin.departures');
    Route::post('/admin/post/store', [AdminController::class, 'storeDeparture'])->name('admin.post.store');
    Route::get('/admin/departures/{id}/edit', [AdminController::class, 'editdeparture'])->name('admin.departure.edit');
    Route::put('/admin/departures/{id}', [AdminController::class, 'updatedeparture'])->name('admin.departure.update');
    Route::delete('/admin/departures/{id}', [AdminController::class, 'destroydeparture'])->name('admin.departure.delete');
    // Route::get('/admin/departures/{id}/view', [AdminController::class, 'view'])->name('admin.departure.view');


    // routes

    Route::get('/admin/routes', [AdminController::class, 'routes'])->name('admin.routes');
    Route::post('/admin/routes/store', [AdminController::class, 'storeRoutes'])->name('admin.routes.store');
    Route::get('/admin/routes/{id}/edit', [AdminController::class, 'editRoute'])->name('admin.routes.edit');
    Route::put('/admin/routes/{id}', [AdminController::class, 'updateRoute'])->name('admin.route.update');
    Route::delete('/admin/routes/{id}', [AdminController::class, 'destroyRoute'])->name('admin.route.delete');



    // inclusion

    Route::get('/admin/inclusions', [AdminController::class, 'inclusions'])->name('admin.inclusions');
    Route::post('/admin/inclusions/store', [AdminController::class, 'storeInclusions'])->name('admin.inclusions.store');
    Route::get('/admin/inclusions/{id}/edit', [AdminController::class, 'editInclusions'])->name('admin.inclusions.edit');
    Route::put('/admin/inclusions/{id}', [AdminController::class, 'updateInclusions'])->name('admin.inclusions.update');
    Route::delete('/admin/inclusions/{id}', [AdminController::class, 'destroyinclusions'])->name('admin.inclusions.delete');



    // airtickets

    Route::get('/admin/airtickets', [AdminController::class, 'airtickets'])->name('admin.airtickets');
    Route::post('/admin/airtickets/store', [AdminController::class, 'storeAirtickets'])->name('admin.airtickets.store');
    Route::get('/admin/airtickets/{id}/edit', [AdminController::class, 'editAirtickets'])->name('admin.airtickets.edit');
    Route::put('/admin/airtickets/{id}', [AdminController::class, 'updateAirtickets'])->name('admin.airtickets.update');
    Route::delete('/admin/airtickets/{id}', [AdminController::class, 'destroyAirtickets'])->name('admin.airtickets.delete');




//Tour Packages routes

        Route::get('/admin/default', [AdminController::class, 'admindefault'])->name('admin.default');
        Route::get('/admin/default_tour', [AdminController::class, 'admindefaulttour'])->name('admin.default_tour');
        Route::post('/admin/default_tour/store', [AdminController::class, 'storedefault_tour'])->name('admin.default_tour.store');

        Route::get('/admin/get-subcategories', [AdminController::class, 'getSubCategories'])->name('admin.get_subcategories');
        Route::get('/admin/get-departures', [AdminController::class, 'getDepartures'])->name('admin.get_departures');
        Route::get('/admin/get-routes', [AdminController::class, 'getRoutes'])->name('admin.get_routes');
        Route::get('/admin/get-inclusions', [AdminController::class, 'getInclusions'])->name('admin.get_inclusions');
        Route::get('/admin/get-airtickets', [AdminController::class, 'getAirTickets'])->name('admin.get_airtickets');
        Route::get('/admin/getGuides', [AdminController::class, 'getGuides'])->name('admin.getGuides');

        Route::get('/admin/default_tour/{id}', [AdminController::class, 'viewTourPackage'])->name('admin.default_tour.view');

        Route::get('/admin/default_tour/{id}/edit', [AdminController::class, 'editTourPackage'])->name('admin.default_tour.edit');
        Route::get('/admin/get_subcategories/{category_id}', [AdminController::class, 'getSubCatego']);
        Route::get('/admin/get_departures/{category_id}', [AdminController::class, 'getDepartu']);
        Route::get('/admin/get_routes/{category_id}', [AdminController::class, 'getRout']);
        Route::get('/admin/get_inclusions/{category_id}',[AdminController::class, 'getInclus']);
        Route::get('/admin/get_airtickets/{category_id}', [AdminController::class, 'getAir']);
        Route::get('/admin/get_guides/{category_id}', [AdminController::class, 'getGuide'])->name('admin.get_guides');
        Route::put('/admin/default_tour/{id}', [AdminController::class, 'updateTourPackage'])->name('admin.default_tour.update');

        Route::delete('/admin/default_tour/{id}', [AdminController::class, 'deleteTourPackage'])->name('admin.default_tour.delete');
        Route::get('/admin/customize_tour', [AdminController::class, 'admincustomize_tour'])->name('admin.customize_tour');



//guide
        Route::get('/admin/Guide', [AdminController::class, 'adminGuide'])->name('admin.guide');
        Route::get('/admin/guide/register', [AdminController::class, 'guideRegister'])->name('admin.create_guide');
        Route::post('/admin/guide/store', [AdminController::class, 'storeGuide'])->name('admin.store_guide');

        Route::get('/admin/guide/{id}', [AdminController::class, 'viewGuide'])->name('admin.view_guide');
        Route::post('/admin/guide/{id}/change-password', [AdminController::class, 'changePassword'])->name('admin.change_password');

        Route::get('/admin/guide/{id}/edit', [AdminController::class, 'editGuide'])->name('admin.edit_guide');
        Route::put('/admin/guide/{id}', [AdminController::class, 'updateGuide'])->name('admin.update_guide');

        Route::post('/admin/guide/delete/{id}', [AdminController::class, 'destroyGuide'])->name('guide.destroy');






//Gallery routes
    Route::get('/admin/gallery', [GalleryController::class, 'adminGallery'])->name('admin.gallery');

    Route::get('/admin/photos', [GalleryController::class, 'adminphotos'])->name('admin.photos');
    Route::post('/admin/photos', [GalleryController::class, 'storePhotos'])->name('admin.photos.store');
    Route::get('/admin/photos/delete/{id}', [GalleryController::class, 'deletePhoto'])->name('admin.photos.delete');

    Route::get('/admin/videos', [GalleryController::class, 'adminvideos'])->name('admin.videos');
    Route::post('/admin/videos', [GalleryController::class, 'storeVideos'])->name('admin.Videos.store');
    Route::get('/admin/videos/delete/{id}', [GalleryController::class, 'deleteVideo'])->name('admin.Videos.delete');


// Booking
Route::get('/admin/booking', [AdminController::class, 'adminBooking'])->name('admin.booking');
Route::get('/admin/view/bookings/{id}', [AdminController::class, 'viewBookings'])->name('admin.viewBooking');






//Admin setting
Route::get('/admin/color/edit', [AdminController::class, 'edit_color'])->name('color.edit');
Route::post('/admin/color/update', [AdminController::class, 'update_color'])->name('color.update');

//users details
Route::get('/admin/users', [AdminController::class, 'users'])->name('users');
Route::delete('/users/{id}', [AdminController::class, 'user_destroy'])->name('users.destroy');


//customized tours
Route::get('/admin/customized-tours', [AdminController::class, 'admin_customized_tours'])->name('customized.tours');
Route::get('/admin/view/custom-tour/{id}', [AdminController::class, 'view_custom_tour'])->name('view.custom.tour');
Route::post('/admin/confirm-tour/{id}', [AdminController::class, 'confirm_tour'])->name('admin.confirm_tour');


//admin settings
    Route::get('/admin/admin/register', [AdminController::class, 'adminRegister'])->name('admin.create_admin');
    Route::get('/admin/index', [AdminController::class, 'admin_view'])->name('admin.index');
    Route::get('/admin/admin/{id}/edit', [AdminController::class, 'editAdmin'])->name('admin.edit_admin');
    Route::put('/admin/admin/{id}', [AdminController::class, 'updateAdmin'])->name('admin.update_admin');
    Route::post('/admin/store', [AdminController::class, 'storeAdmin'])->name('admin.store_admin');
    Route::post('/admin/admin/delete/{id}', [AdminController::class, 'admin_destroy'])->name('admin.destroy');
    Route::post('/admin/{id}/change-password', [AdminController::class, 'adminChangePassword'])->name('admin.admin_password');


});


//transport
Route::get('/admin/transport', [AdminController::class, 'transport'])->name('admin.transport');
Route::get('/admin/transport/create', [AdminController::class, 'add_transport'])->name('admin.create_transport');
Route::post('/admin/transport/store', [AdminController::class, 'store_transport'])->name('admin.store_transport');
Route::get('/admin/transport/{id}/edit', [AdminController::class, 'edit_transport'])->name('admin.edit_transport');
Route::put('/admin/transport/update/{id}', [AdminController::class, 'update_transport'])->name('admin.update_transport');
Route::delete('/admin/transport/{id}', [AdminController::class, 'destroy_transport'])->name('admin.destroy_transport');


