<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'csadmin'], function () {
	Route::get('/', [App\Http\Controllers\csadmin\LoginController::class, 'adminLogin'])->name('adminLogin');
	Route::post('/login/loginAdminProcess', [App\Http\Controllers\csadmin\LoginController::class, 'adminlogincheck'])->name('adminlogincheck');
	Route::get('/forgot-password', [App\Http\Controllers\csadmin\LoginController::class, 'forgotpassword'])->name('csadmin.forgotpassword');

	Route::group(['middleware' => 'AdminSession'], function () {
		Route::get('/dashboard', [App\Http\Controllers\csadmin\DashboardController::class, 'index'])->name('csadmin.dashboard.index');

		// Apperence Controller
		Route::group(['prefix' => 'appearance'], function () {
			Route::get('menu/{id?}', [App\Http\Controllers\csadmin\AppearenceController::class, 'menu'])->name('csadmin.appearence.menu');
			Route::post('menu-process', [App\Http\Controllers\csadmin\AppearenceController::class, 'menuprocess'])->name('csadmin.appearence.menuprocess');
			Route::get('menu-status/{id?}', [App\Http\Controllers\csadmin\AppearenceController::class, 'menustatus'])->name('csadmin.appearence.menustatus');
			Route::get('menu-delete/{id?}', [App\Http\Controllers\csadmin\AppearenceController::class, 'deletemenu'])->name('csadmin.appearence.deletemenu');
			
			Route::get('slider/', [App\Http\Controllers\csadmin\AppearenceController::class, 'slider'])->name('csadmin.appearence.slider');
			Route::get('add-slider/{id?}', [App\Http\Controllers\csadmin\AppearenceController::class, 'addslider'])->name('csadmin.appearence.addslider');
			Route::post('slider-process/{id?}', [App\Http\Controllers\csadmin\AppearenceController::class, 'sliderProcess'])->name('csadmin.appearence.sliderProcess');
			Route::get('slider-delete/{id?}', [App\Http\Controllers\csadmin\AppearenceController::class, 'sliderDelete'])->name('csadmin.appearence.sliderDelete');
			Route::get('slider-status/{id?}', [App\Http\Controllers\csadmin\AppearenceController::class, 'sliderstatus'])->name('csadmin.appearence.sliderstatus');



			Route::get('/footer', [App\Http\Controllers\csadmin\AppearenceController::class, 'footer'])->name('csadmin.appearance.footer');
			Route::any('footerProcess', [App\Http\Controllers\csadmin\AppearenceController::class, 'footerProcess'])->name('csadmin.appearance.footerProcess');
		});
		
		// Faq Controller
		Route::get('faq/', [App\Http\Controllers\csadmin\FaqController::class, 'faq'])->name('csadmin.faq.faq');
			Route::get('add-faq/{id?}', [App\Http\Controllers\csadmin\FaqController::class, 'addfaq'])->name('csadmin.faq.addfaq');
			Route::post('faq-process/{id?}', [App\Http\Controllers\csadmin\FaqController::class, 'faqProcess'])->name('csadmin.faq.faqProcess');
			Route::get('faq-delete/{id?}', [App\Http\Controllers\csadmin\FaqController::class, 'faqDelete'])->name('csadmin.faq.faqDelete');
			Route::get('faq-status/{id?}', [App\Http\Controllers\csadmin\FaqController::class, 'faqstatus'])->name('csadmin.faq.faqstatus');
			
			// Enquiry Controller
			Route::get('contact-us', [App\Http\Controllers\csadmin\EnquiryController::class, 'index'])->name('csadmin.enquiry.contact');
			Route::get('contact-us-delete/{id?}', [App\Http\Controllers\csadmin\EnquiryController::class, 'contactDelete'])->name('csadmin.enquiry.contactDelete');

		/** ProductController **/
		Route::group(['prefix' => 'product'], function () {
			Route::any('/', [App\Http\Controllers\csadmin\ProductController::class, 'index'])->name('csadmin.product.index');
			Route::any('add-product/{id?}', [App\Http\Controllers\csadmin\ProductController::class, 'addproduct'])->name('csadmin.product.addproduct');
			Route::post('add-product-process/{id?}', [App\Http\Controllers\csadmin\ProductController::class, 'addproductprocess'])->name('csadmin.product.addproductprocess');
			Route::any('add-product-checkslug', [App\Http\Controllers\csadmin\ProductController::class, 'addproductcheckslug'])->name('csadmin.product.checkslug');
			Route::any('delete-product/{id}', [App\Http\Controllers\csadmin\ProductController::class, 'deleteproduct'])->name('csadmin.product.deleteproduct');
			Route::any('product-status/{id}', [App\Http\Controllers\csadmin\ProductController::class, 'productstatus'])->name('csadmin.product.productstatus');
			Route::get('checkfeatured/{id?}', [App\Http\Controllers\csadmin\ProductController::class, 'checkfeatured'])->name('csadmin.product.checkfeatured');

			Route::get('category/{id?}', [App\Http\Controllers\csadmin\ProductController::class, 'category'])->name('csadmin.product.category');
			Route::post('add-category-process/{id?}', [App\Http\Controllers\csadmin\ProductController::class, 'addcategoryprocess'])->name('csadmin.category.addcategoryprocess');
			Route::any('category-status/{id}', [App\Http\Controllers\csadmin\ProductController::class, 'categorystatus'])->name('csadmin.category.categorystatus');
			Route::any('delete-category/{id}', [App\Http\Controllers\csadmin\ProductController::class, 'deletecategory'])->name('csadmin.category.deletecategory');



		});

		/** OurTeamController **/
		Route::any('/ourteam', [App\Http\Controllers\csadmin\OurteamController::class, 'ourteam'])->name('csadmin.ourteam.ourteam');
		Route::any('ourteam/addteam/{id?}', [App\Http\Controllers\csadmin\OurteamController::class, 'addteam'])->name('csadmin.ourteam.addteam');
		Route::any('ourteam/teamProcess/{id?}', [App\Http\Controllers\csadmin\OurteamController::class, 'teamProcess'])->name('csadmin.ourteam.teamProcess');
		Route::any('ourteam/deleteteam/{id}', [App\Http\Controllers\csadmin\OurteamController::class, 'deleteteam'])->name('csadmin.ourteam.deleteteam');
		Route::any('ourteam/statusteam/{id}', [App\Http\Controllers\csadmin\OurteamController::class, 'statusteam'])->name('csadmin.ourteam.statusteam');
		Route::any('ourteam/teamfeatured/{id}', [App\Http\Controllers\csadmin\OurteamController::class, 'teamfeatured'])->name('csadmin.ourteam.teamfeatured');


		/** MediaController **/
		Route::any('/media', [App\Http\Controllers\csadmin\MediaController::class, 'media'])->name('csadmin.media');
		Route::any('media/addmedia/{id?}', [App\Http\Controllers\csadmin\MediaController::class, 'addmedia'])->name('csadmin.addmedia');
		Route::any('media/mediaProcess/{id?}', [App\Http\Controllers\csadmin\MediaController::class, 'mediaProcess'])->name('csadmin.mediaProcess');
		Route::any('media/deletemedia/{id}', [App\Http\Controllers\csadmin\MediaController::class, 'deletemedia'])->name('csadmin.deletemedia');

		// Page Controller
		Route::group(['prefix' => 'page'], function () {
			Route::get('', [App\Http\Controllers\csadmin\PageController::class, 'page'])->name('csadmin.page.page');
			Route::get('add-page/{pageid?}', [App\Http\Controllers\csadmin\PageController::class, 'addpage'])->name('csadmin.page.addpage');
			Route::post('add-page-process', [App\Http\Controllers\csadmin\PageController::class, 'addpageprocess'])->name('csadmin.page.addpageprocess');
			Route::get('page-status/{id?}', [App\Http\Controllers\csadmin\PageController::class, 'pagestatus'])->name('csadmin.page.pagestatus');
			Route::get('page-delete/{id?}', [App\Http\Controllers\csadmin\PageController::class, 'deletepage'])->name('csadmin.page.deletepage');
			Route::any('check-slug', [App\Http\Controllers\csadmin\PageController::class, 'checkslug'])->name('csadmin.checkslug');
		});

		/* Settings Section */
		Route::group(['prefix' => 'setting'], function () {
			Route::get('site-setting', [App\Http\Controllers\csadmin\SettingsController::class, 'siteSetting'])->name('csadmin.settings.sitesetting');
			Route::get('social-setting', [App\Http\Controllers\csadmin\SettingsController::class, 'socialsetting'])->name('csadmin.settings.socialsetting');
			Route::post('site-settings-process', [App\Http\Controllers\csadmin\SettingsController::class, 'sitesettingsprocess'])->name('csadmin.settings.sitesettingsprocess');
			Route::post('social-setting-process', [App\Http\Controllers\csadmin\SettingsController::class, 'socialsettingprocess'])->name('csadmin.settings.socialsettingprocess');
			Route::any('change-password', [App\Http\Controllers\csadmin\SettingsController::class, 'changepassword'])->name('csadmin.settings.changepassword');
			Route::any('change-password-process', [App\Http\Controllers\csadmin\SettingsController::class, 'changepasswordprocess'])->name('csadmin.settings.changepasswordprocess');

		});
		Route::get('/logout', [App\Http\Controllers\csadmin\LoginController::class, 'logout'])->name('csadmin.adminLogout');
	});
});

