<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\Backend\PostTags;
use App\Models\Backend\PostCategorie;
use App\Models\Backend\Genre;
use App\Models\Backend\Category;
use App\Models\Backend\Cast;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PostTagsController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\CastController;
use App\Http\Controllers\Backend\GenreController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\MovieController;
use App\Http\Controllers\Backend\SerieController;
use App\Http\Controllers\Backend\GameController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\NotificationController;

use App\Http\Controllers\Frontend\FrontendCastController;
use App\Http\Controllers\Frontend\FrontendMovieController;
use App\Http\Controllers\Frontend\FrontendSerieController;
use App\Http\Controllers\Frontend\FrontendGameController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CheckoutController;


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

///////// Backend Route Start /////////

Route::middleware('auth')->group(function () {
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

//Backend Auth Route
Route::middleware(['auth','role:admin'])->group(function () {

    //Backend Admin Route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/logout',  'logOut')->name('admin.logout');
        Route::get('/admins/profile', 'AdminProfile')->name('admin.profile');
        Route::post('/admin/update/password',  'AdminUpdatePassword')->name('update.password');
        Route::post('/admin/profile/store',  'AdminProfileStore')->name('admin.profile.store');

        Route::get('/admins', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/admin/user/store',  'AdminUserStore')->name('admin.user.store');
        Route::get('/edit/admin/role/{id}' ,  'EditAdminRole')->name('edit.admin.role');
        Route::post('/admin/user/update/{id}',  'AdminUserUpdate')->name('admin.user.update');
        Route::get('/delete/admin/role/{id}' ,  'DeleteAdminRole')->name('delete.admin.role');

        Route::get('/users', 'AllUser')->name('all.user');
        Route::get('/add/user', 'AddUser')->name('add.user');
    });

    //Backend Blog Route
    Route::get('/backend/blogs',[BlogController::class, 'index'])->name('blogs');
    Route::get('/backend/posts/detail/{id}',[BlogController::class, 'detail'])->name('posts.detail');
    Route::get('/backend/blogs/active',[BlogController::class, 'ActivePost'])->name('blogs.active');
    Route::get('/backend/blogs/inactive',[BlogController::class, 'InactivePost'])->name('blogs.inactive');
    Route::get('/backend/blogs/inactive/{id}' , [BlogController::class, 'PostInactive'])->name('post.inactive');
    Route::get('/backend/blogs/active/{id}' , [BlogController::class, 'PostActive'])->name('post.active');
    Route::get('/backend/posts/create',[BlogController::class, 'create'])->name('posts.create');
    Route::post('/backend/posts/store',[BlogController::class, 'store'])->name('posts.store');
    Route::get('/backend/posts/edit/{id}',[BlogController::class, 'edit'])->name('posts.edit');
    Route::post('/backend/posts/update',[BlogController::class, 'update'])->name('posts.update');
    Route::get('/backend/posts/delete/{id}' , [BlogController::class, 'destroy'])->name('posts.delete');

    //Backend Categorie for Post
    Route::get('/backend/posts/categories',[BlogController::class, 'PostCategoryIndex'])->name('posts.categories');
    Route::post('/backend/posts/categories/store',[BlogController::class, 'PostCategoryStore'])->name('posts.categories.store');
    Route::get('/backend/posts/categories/edit/{id}',[BlogController::class, 'PostCategoryEdit'])->name('posts.categories.edit');
    Route::post('/backend/posts/categories/update',[BlogController::class, 'PostCategoryUpdate'])->name('posts.categories.update');
    Route::get('/backend/post/categories/delete/{id}' , [BlogController::class, 'PostCategoryDestroy'])->name('posts.categories.delete');

    //Backend Tag for Post
    Route::get('/backend/posts/tags',[BlogController::class, 'PostTagIndex'])->name('posts.tags');
    Route::post('/backend/posts/tags/store',[BlogController::class, 'PostTagStore'])->name('posts.tags.store');
    Route::get('/backend/posts/tags/edit/{id}',[BlogController::class, 'PostTagEdit'])->name('posts.tags.edit');
    Route::post('/backend/posts/tags/update',[BlogController::class, 'PostTagUpdate'])->name('posts.tags.update');
    Route::get('/backend/post/tags/delete/{id}' , [BlogController::class, 'PostTagDestroy'])->name('posts.tags.delete');

    Route::get('/tag-names',function(){
        $tag=PostTags::all()->pluck('name')->toArray();
        return response($tag);
    });

    Route::get('/category-names',function(){
        $category=PostCategorie::all()->pluck('name')->toArray();
        return response($category);
    });

    //Backend Role & Permission Route
    Route::controller(RoleController::class)->group(function(){
        //Backend Permission Route
        Route::get('/backend/all/permission','AllPermission')->name('all.permission');
        Route::get('/backend/add/permission','AddPermission')->name('add.permission');
        Route::post('/backend/store/permission','StorePermission')->name('store.permission');
        Route::get('/backend/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/backend/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/backend/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

        //Backend Role Route
        Route::get('/backend/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/backend/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/backend/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/backend/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::post('/backend/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/backend/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');

        // add role permission
        Route::get('/backend/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/backend/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('/backend/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
        Route::get('/backend/admin/edit/roles/{id}', 'AdminRolesEdit')->name('admin.edit.roles');
        Route::post('/backend/admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/backend/admin/delete/roles/{id}', 'AdminRolesDelete')->name('admin.delete.roles');
    });

    //Backend Casts Route
    Route::controller(CastController::class)->group(function(){
        Route::get('/backend/casts', 'CastIndex')->name('casts');
        Route::get('/backend/casts/create', 'CastCreate')->name('casts.create');
        Route::post('/backend/casts/create',  'CastStore')->name('casts.store');
        Route::get('/backend/casts/edit/{id}', 'CastEdit')->name('casts.edit');
        Route::post('/backend/casts/update',  'CastUpdate')->name('casts.update');
        Route::get('/backend/casts/delete/{id}' ,  'CastDestroy')->name('casts.delete');
    });

    //Backend Genre Route
    Route::controller(GenreController::class)->group(function(){
        Route::get('/backend/genres','GenreIndex')->name('genres');
        Route::post('/backend/genres/store', 'GenreStore')->name('genres.store');
        Route::get('/backend/genres/edit/{id}','GenreEdit')->name('genres.edit');
        Route::post('/backend/genres/update','GenreUpdate')->name('genres.update');
        Route::get('/backend/genres/delete/{id}' ,'GenreDestroy')->name('genres.delete');
    });

    //Backend Category Route
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/backend/categories','CategoryIndex')->name('categories');
        Route::post('/backend/categories/store', 'CategoryStore')->name('categories.store');
        Route::get('/backend/categories/edit/{id}','CategoryEdit')->name('categories.edit');
        Route::post('/backend/categories/update','CategoryUpdate')->name('categories.update');
        Route::get('/backend/categories/delete/{id}' , 'CategoryDestroy')->name('categories.delete');
    });

    //Backend Movies Route
    Route::controller(MovieController::class)->group(function(){
        Route::get('/backend/movies', 'Movies')->name('movies');
        Route::get('/backend/movies/create', 'MoviesCreate')->name('movies.create');
        Route::post('/backend/movies/store',  'MovieStore')->name('movies.store');
        Route::get('/backend/movies/inactive/{id}' ,  'MovieInactive')->name('movies.inactive');
        Route::get('/backend/movies/active/{id}' ,  'MovieActive')->name('movies.active');
        Route::get('/backend/movies/edit/{id}', 'MovieEdit')->name('movies.edit');
        Route::post('/backend/movies/update',  'MovieUpdate')->name('movies.update');
        Route::get('/backend/movies/delete/{id}' ,  'MovieDestroy')->name('movies.delete');

        Route::get('/movies-genre',function(){
            $genres=Genre::where('type', 'movie')->pluck('name')->toArray();
            return response($genres);
        });
        Route::get('/movies-category',function(){
            $categories=Category::where('type', 'movie')->pluck('name')->toArray();
            return response($categories);
        });
        Route::get('/cast',function(){
            $casts=Cast::all()->pluck('name')->toArray();
            return response($casts);
        });

    });

    //Backend Series Route
    Route::controller(SerieController::class)->group(function(){
        Route::get('/backend/series','Series')->name('series');
        Route::get('/backend/series/create','SeriesCreate')->name('series.create');
        Route::post('/backend/series/store', 'SeriesStore')->name('series.store');
        Route::get('/backend/series/inactive/{id}' , 'SerieInactive')->name('series.inactive');
        Route::get('/backend/series/active/{id}' , 'SerieActive')->name('series.active');
        Route::get('/backend/series/edit/{id}', 'SerieEdit')->name('series.edit');
        Route::post('/backend/series/update', 'SerieUpdate')->name('series.update');

        Route::get('/series-genre',function(){
            $genres=Genre::where('type', 'serie')->pluck('name')->toArray();
            return response($genres);
        });
        Route::get('/series-category',function(){
            $categories=Category::where('type', 'serie')->pluck('name')->toArray();
            return response($categories);
        });
        Route::get('/cast',function(){
            $casts=Cast::all()->pluck('name')->toArray();
            return response($casts);
        });
        Route::get('/backend/series/delete/{id}' , 'SerieDestroy')->name('series.delete');
    });

    //Backend Games Route
    Route::controller(GameController::class)->group(function(){
        Route::get('/backend/games','Games')->name('games');
        Route::get('/backend/games/create', 'GamesCreate')->name('games.create');
        Route::post('/backend/games/store', 'GamesStore' )->name('games.store');
        Route::get('/backend/games/inactive/{id}' , 'GamesInactive')->name('games.inactive');
        Route::get('/backend/games/active/{id}' , 'GamesActive')->name('games.active');
        Route::get('/backend/games/edit/{id}','GamesEdit')->name('games.edit');
        Route::post('/backend/games/update', 'GamesUpdate')->name('games.update');

        Route::get('/games-genre',function(){
            $genres=Genre::where('type', 'game')->pluck('name')->toArray();
            return response($genres);
        });
        Route::get('/backend/games/delete/{id}' , 'GamesDestroy')->name('games.delete');
    });

    //Backend Order Route
    Route::controller(OrderController::class)->group(function(){
        Route::get('/backend/orders' , 'Orders')->name('orders');
        Route::get('/backend/pending/orders' , 'OrdersPending')->name('pending.orders');
        Route::get('/backend/complete/orders' , 'OrdersComplete')->name('complete.orders');
        Route::get('/admin/order/details/{order_id}' , 'AdminOrderDetails')->name('admin.order.details');
        Route::get('/backend/order/complete/{id}' , 'OrderComplete')->name('order.complete');
        Route::get('/backend/order/pending/{id}' , 'OrderPending')->name('order.pending');
        Route::get('/backend/order/delete/{id}' , 'OrderDelete')->name('order.delete');
    });

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/backend/dashboard' , 'dashboard')->name('admin.dashboard');
    });

    Route::controller(NotificationController::class)->group(function(){
        Route::get('/mark-all-as-read' , 'markAllAsRead')->name('markAllAsRead');
    });

});

///////// Backend Route End /////////



///////// Frontend Route Start /////////
    Route::get('/sidebar', 'SidebarController@showSidebar')->name('sidebar');

    Route::controller(HomeController::class)->group(function(){
        Route::get('/','dashboard')->name('/');
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/detail/{id}' , 'Detail')->name('dc.detail');
        Route::post('/search' , 'ProductSearch')->name('product.search');
        Route::post('/search-product' , 'SearchProduct');
        Route::get('/contact-us', 'ContactUs')->name('contact.us');
    });

    //Frontend Blog Route
    Route::controller(BlogController::class)->group(function(){
        Route::get('/blogs',  'DCindex')->name('dc.blogs');
        Route::get('/blogs/detail/{id}', 'DCdetail')->name('dc.blogs.detail');
        Route::get('/blogs/user/{id}', 'DCUserPost')->name('dc.user.blogs');
        Route::post('/blogs/comment', 'DCPostCommentStore')->name('dc.post.comment');
        Route::get('/blogs/categories/{id}', 'DCPostCategory')->name('dc.blogs.categories');
        Route::get('/blogs/tags/{id}', 'DCPostTag')->name('dc.blogs.tags');
        Route::get('/blogs/date/{date}',  'DCPostDate')->name('dc.blogs.date');
    });

    //Frontend Cast Route
    Route::controller(FrontendCastController::class)->group(function(){
        Route::get('/casts', 'index')->name('dc.casts');
        Route::get('/casts/detail/{id}', 'CastDetail')->name('dc.casts.detail');
    });

    //Frontend Movie Route
    Route::controller(FrontendMovieController::class)->group(function(){
        Route::get('/movies',  'index')->name('dc.movies');
        Route::get('/movies/detail/{id}', 'MovieDetail')->name('dc.movies.detail');
        Route::get('/movies/years/{release_date}',  'MovieYear')->name('dc.movies.years');
        Route::get('/movies/categories/{id}',  'MovieCategory')->name('dc.movies.categories');
        Route::get('/movies/genres/{id}',  'MovieGenre')->name('dc.movies.genres');
        Route::post('/movies/comment', 'MovieDetailCommentStore')->name('dc.movies.comment');
    });


    //Frontend Series Route
    Route::controller(FrontendSerieController::class)->group(function(){
        Route::get('/series',  'SerieIndex')->name('dc.series');
        Route::get('/series/detail/{id}', 'SerieDetail')->name('dc.series.detail');
        Route::get('/series/years/{release_date}',  'SeriesYear')->name('dc.series.years');
        Route::get('/series/categories/{id}',  'SerieCategory')->name('dc.series.categories');
        Route::get('/series/genres/{id}',  'SerieGenre')->name('dc.series.genres');
        Route::post('/series/comment', 'SerieDetailCommentStore')->name('dc.series.comment');
    });

    //Frontend Games Route
    Route::controller(FrontendGameController::class)->group(function(){
        Route::get('/games',  'GameIndex')->name('dc.games');
        Route::get('/games/detail/{id}', 'GameDetail')->name('dc.games.detail');
        Route::get('/games/years/{release_date}',  'GameYear')->name('dc.games.years');
        Route::get('/games/genres/{id}',  'GameGenre')->name('dc.games.genres');
        Route::post('/games/comment', 'GameDetailCommentStore')->name('dc.games.comment');
    });


    /// Add To Cart Route
    Route::controller(CartController::class)->group(function(){
        Route::post('/cart/data/store/{id}',  'AddToCard');
        Route::post('/dcart/data/store/{id}',  'AddToCartDetails');
        Route::get('/movie/mini/cart',  'AddMiniCart');
        Route::get('/minicart/movie/remove/{rowId}',  'RemoveMiniCart');
    });


    /// Add To Wishlist Route
    Route::post('/add-to-wishlist/{movie_id}', [WishlistController::class, 'AddToWishList']);

    /// User All Route
    Route::middleware(['auth','role:user'])->group(function() {

        // Wishlist All Route
        Route::controller(WishlistController::class)->group(function(){
            Route::get('/wishlist' , 'AllWishlist')->name('wishlist');
            Route::get('/get-wishlist-movie' , 'GetWishlistMovie');
            Route::get('/wishlist-remove/{id}' , 'WishlistRemove');
        });

        // Cart Route

        Route::controller(CartController::class)->group(function(){
            Route::get('/mycart' , 'MyCart')->name('mycart');
            Route::get('/get-cart-product' , 'GetCartProduct');
            Route::get('/cart-remove/{rowId}' , 'CartRemove');

        });

        Route::controller(CheckoutController::class)->group(function(){
            Route::post('/cash/order' , 'CashOrder')->name('cash.order');
        });

        Route::controller(UserController::class)->group(function(){

            Route::get('/user/account/page' , 'UserAccount')->name('user.account.page');
            Route::get('/user/password/page' , 'UserPassword')->name('user.password.page');
            Route::get('/user/orders' , 'UserOrder')->name('user.orders');
            Route::post('/user/profile/update', 'UserProfileUpdate')->name('user.profile.update');
            Route::post('/user/password/update', 'UserUpdatePassword')->name('user.password.update');
            Route::get('/user/order_details/{order_id}' , 'UserOrderDetails');

           });

    }); // end group middleware

    // Checkout Page Route
    Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');


///////// Frontend Route End /////////

require __DIR__.'/auth.php';
