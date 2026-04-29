<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PropertyController;
// use App\Models\ContactInquiry;
// use App\Models\Property;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SeoPageController;
use App\Http\Controllers\Admin\ContactInquiryController as AdminContactInquiryController;
use App\Http\Controllers\Admin\SystemToolsController as AdminSystemToolsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Main landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// SEO landings
Route::get('/luxury-stays-korcula', [SeoPageController::class, 'show'])->defaults('slug', 'luxury-stays-korcula')->name('seo.page.luxury');
Route::get('/historic-houses-korcula-old-town', [SeoPageController::class, 'show'])->defaults('slug', 'historic-houses-korcula-old-town')->name('seo.page.historic');
Route::get('/destination-weddings-korcula', [SeoPageController::class, 'show'])->defaults('slug', 'destination-weddings-korcula')->name('seo.page.weddings');
Route::get('/sitemap.xml', [SeoPageController::class, 'sitemap'])->name('sitemap');

// Properties
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');
Route::get('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// Newsletter subscription
Route::post('/newsletter', [NewsletterController::class, 'store'])
    ->middleware('throttle:3,1')
    ->name('newsletter.store');

// Static pages
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

// Legacy alias for /inquiry — redirects to canonical /contact
Route::post('/inquiry', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('inquiry.store');

Route::match(['get', 'post'], '/admin/contact-inquiries', [AdminContactInquiryController::class, 'index'])
    ->name('admin.contact-inquiries');

Route::post('/admin/contact-inquiries/{contactInquiry}/status', [AdminContactInquiryController::class, 'updateStatus'])
    ->name('admin.contact-inquiries.status');

Route::post('/admin/contact-inquiries/logout', [AdminContactInquiryController::class, 'logout'])
    ->name('admin.contact-inquiries.logout');

Route::match(['get', 'post'], '/admin/system-tools', [AdminSystemToolsController::class, 'index'])
    ->name('admin.system-tools');

Route::post('/admin/system-tools/run', [AdminSystemToolsController::class, 'run'])
    ->name('admin.system-tools.run');

