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
use App\Http\Controllers\frontendController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Models\Ingredient;
use App\Models\IngredientsCategory;
use App\Http\Controllers\ProfileController;


use App\Models\Recipe;
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
Route::get('/test',[RecipeController::class,'display'])->name('test');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/about', [HomeController::class, 'about'])->name('User.Frontend.about');

Route::post('tags', [IngredientController::class, 'getIngredient'])->name('get-ingredient')->middleware('auth');
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('users.recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('user.recipes.store');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('user.recipes.show');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('user.recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('user.recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('user.recipes.destroy');
    
    Route::get('/profile',[ProfileController::class, 'profile'])->name('user.profile');
    Route::post('/save-image',[ProfileController::class,'saveImage'])->name('user.saveImage');
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

    //search

    Route::get('/index', [RecipeController::class, 'index'])->name('recipes.search');
    Route::get('/autocomplete/recipes', [RecipeController::class, 'autocomplete'])->name('autocomplete.recipes');

    

    

});
Route::middleware(['auth', 'isAdmin'])->group(function () {
    //redirect to dashboard with charts
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //import and export in excel
    //Recipe Categories
    Route::get('/import-categories', [CategoryController::class, 'importCategories'])->name('categories.import');
    Route::post('/upload-categories', [CategoryController::class, 'uploadCategories'])->name('categories.upload');
    //Ingredient Categories
    Route::get('/import-ingredientCategories', [IngredientCategoryController::class, 'importingredientCategory'])->name('categories_ingredients.import');
    Route::post('/upload-ingredientCategories', [IngredientCategoryController::class, 'uploadingredientCategories'])->name('categories_ingredients.upload');
    //Ingredient
    Route::get('/import-ingredients', [IngredientController::class, 'importingredient'])->name('ingredients.import');
    Route::post('/upload-ingredients', [IngredientController::class, 'uploadingredient'])->name('ingredients.upload');
    //Recipe
    Route::get('/import-recipes', [RecipeController::class, 'importrecipe'])->name('recipes.import');
    Route::post('/upload-recipes', [RecipeController::class, 'uploadrecipe'])->name('recipes.upload');

    //Exports
    Route::get('categories/export/', [CategoryController::class, 'export'])->name('categories.export');
    Route::get('categoriesingredients/export/', [IngredientCategoryController::class, 'export'])->name('categories_ingredient.export');
    Route::get('ingredients/export/', [IngredientController::class, 'export'])->name('ingredients.export');
    Route::get('recipes/export/', [RecipeController::class, 'export'])->name('recipes.export');

   //pdf
   Route::get('/export-ingredientCategories', [IngredientCategoryController::class, 'exportingredientCategories'])->name('categories_ingredients.export');


    //CRUD
    //Recipes
    Route::get('/recipes', [AdminController::class, 'recipeIndex'])->name('recipes.index');
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
    Route::get('/ingredients', [AdminController::class, 'ingIndex'])->name('ingredients.index');
    Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('ingredients.create');
    Route::post('/ingredients', [IngredientController::class, 'store'])->name('ingredients.store');
    Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->name('ingredients.edit');
    Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('ingredients.update');
    Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('ingredients.destroy');
    
    //orders
    Route::get('orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('Admin/view-order/{id}',[OrderController::class,'view']);
    Route::put('update-order/{id}',[OrderController::class, 'updateorder']);
    Route::get('order-history',[OrderController::class, 'orderhistory']);
});
