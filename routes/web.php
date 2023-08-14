<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientCategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Models\IngredientsCategory;
use Illuminate\Routing\RouteGroup;

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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->middleware('auth');


Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/recipes', [RecipeController::class, 'index'])->name('user-recipe.index');
    Route::get('/ingredients', [IngredientController::class, 'index'])->name('user-ingredient.index');
    Route::get('/ingredients/{ingredient}', [IngredientController::class, 'ingredientsview'])->name('User.ingredients.view');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'recipesview'])->name('User.recipes.view');
    // cart
    Route::post('/add-to-cart', [CartController::class, 'addIngredient'])->name('add-to-cart');
    Route::get('/load-cart-data',[CartController::class, 'cartcount']);
    Route::get('/cart',[CartController::class, 'viewcart']);
    Route::post('/delete-cart-item', [CartController::class, 'deleteingredient']);
    Route::post('update-cart', [CartController::class, 'updatecart']);
    //checkout
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');;
    Route::post('place-order', [CheckoutController::class, 'placeorder']);
    //wishlist
    Route::post('/add-to-wishlist', [WishlistController::class, 'add'])->name('add-to-cart');
    Route::get('/load-wishlist-data',[WishlistController::class, 'wishlistcount']);
    Route::get('/wishlist',[WishlistController::class,'index']);
    Route::post('/delete-wishlist-item', [WishlistController::class, 'deleteitem']);
    //Orders
    Route::get('/my-orders', [UserController::class,'index']);
    Route::get('/cancel-order/{id}', [UserController::class, 'cancelOrder'])->name('cancel-order');
    Route::get('/view-order/{id}', [UserController::class,'view']);
    //Ratings and Reviewa
    Route::post('/add-rating', [RatingController::class,'add'])->name('user.add-rating');
    Route::post('/add-review', [ReviewController::class,'add'])->name('user.add-review');
    
    //comments edit and delete
    Route::post('edit/{id}', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::post('delete/{id}', [ReviewController::class, 'delete'])->name('reviews.delete');

});
Route::middleware(['auth', 'isAdmin'])->group(function () {
    //redirect to dashboard with charts
    Route::get('/dashboard', [AdminController::class, 'index']);
    //import and export in excel
    Route::get('/import-categories', [CategoryController::class, 'importCategories'])->name('categories.import');
    Route::post('/upload-categories', [CategoryController::class, 'uploadCategories'])->name('categories.upload');

    Route::get('/import-ingredientCategories', [IngredientCategoryController::class, 'importingredientCategory'])->name('categories_ingredients.import');
    Route::post('/upload-ingredientCategories', [IngredientCategoryController::class, 'uploadingredientCategories'])->name('categories_ingredients.upload');
    //CRUD
    //Recipes
    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
    Route::get('/recipes/getData', [RecipeController::class, 'getData'])->name('recipes.getData');
    //Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    //IngredientCategories
    Route::get('categories_ingredients', [IngredientCategoryController::class, 'index'])->name('categories_ingredients.index');
    Route::get('categories_ingredients/create', [IngredientCategoryController::class, 'create'])->name('categories_ingredients.create');
    Route::post('categories_ingredients', [IngredientCategoryController::class, 'store'])->name('categories_ingredients.store');
    Route::get('/categories_ingredients/{ingredientscategories}/edit', [IngredientCategoryController::class, 'edit'])->name('categories_ingredients.edit');
    Route::put('categories_ingredients/{ingredientscategories}', [IngredientCategoryController::class, 'update'])->name('categories_ingredients.update');
    Route::delete('categories_ingredients/{ingredientscategories}', [IngredientCategoryController::class, 'destroy'])->name('categories_ingredients.destroy');
    //ingredients
    Route::get('/ingredients', [IngredientController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
    Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
    Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');
    Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
    Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');
    Route::post('tags', [IngredientController::class, 'getIngredient'])->name('get-ingredient');
    //orders
    Route::get('orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('Admin/view-order/{id}',[OrderController::class,'view']);
    Route::put('update-order/{id}',[OrderController::class, 'updateorder']);
    Route::get('order-history',[OrderController::class, 'orderhistory']);
});
