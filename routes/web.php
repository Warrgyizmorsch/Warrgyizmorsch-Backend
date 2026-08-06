<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CRM\BlogController;
use App\Http\Controllers\CRM\UserController;
use App\Http\Controllers\CRM\RouteController;
use App\Http\Controllers\CRM\RoleController;
use App\Http\Controllers\CRM\MenuController;
use App\Http\Controllers\CRM\RolePermissionController;
use App\Http\Controllers\CRM\UserPermissionController;
use App\Http\Controllers\CRM\BucketController;
use App\Http\Controllers\CRM\LeadController;
use App\Http\Controllers\CRM\LeadQuestionController;
use App\Http\Controllers\CRM\LeadSourceController;
use App\Http\Controllers\CRM\WarrLeadController;
use App\Http\Controllers\CRM\WarrServicePageController;
use App\Http\Controllers\CRM\SubjectPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CRM\NewleadController;
use App\Http\Controllers\CRM\OrderController;
use App\Http\Controllers\CRM\UniversityDetailController;
use App\Http\Controllers\WhatsAppController;

Route::get('/send-whatsapp-all', [WhatsAppController::class, 'sendAll'])
    ->name('send.whatsapp.all');
// Route::get('/send-whatsapp/{userId}', [WhatsAppController::class, 'send'])->name('send.whatsapp.report');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/get-leads-by-type', [LeadController::class, 'getLeadsByType'])
        ->name('get.leads.by.type');

    Route::get('/get-user-report-data', [LeadController::class, 'getUserReportData'])->name('get.user.report.data');

    Route::get('/get-lead-transitions', [LeadController::class, 'getLeadTransitions'])
        ->name('get.lead.transitions');

    Route::post('/lead/bulk-owner-update', [LeadController::class, 'bulkOwnerUpdate'])
        ->name('lead.bulkOwnerUpdate');


    Route::prefix('categories')->group(function () {

        Route::get('/', [CategoryController::class, 'index'])
            ->name('category.index');

        Route::post('/store', [CategoryController::class, 'store'])
            ->name('category.store');

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])
            ->name('category.edit');

        Route::put('/update/{id}', [CategoryController::class, 'update'])
            ->name('category.update');

        Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])
            ->name('category.destroy');

        Route::post('/recover/{id}', [CategoryController::class, 'recover'])
            ->name('category.recover');
    });

    Route::middleware(['check.permission'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
            Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('destroy');

            Route::get('/session', [UserController::class, 'indexLog'])->name('session');
            Route::post('/{user}/logout', [UserController::class, 'forceLogout'])->name('logout');
            Route::get('/{user}/history', [UserController::class, 'userHistory'])->name('history');
            Route::get('/{user}/lead-history', [UserController::class, 'leadHistory'])->name('leadHistory');
        });

        Route::resource('routes', RouteController::class);

        Route::resource('roles', RoleController::class);

        Route::resource('menus', MenuController::class);

        Route::resource('role-permissions', RolePermissionController::class);
        Route::post('roles/{role}/permissions', [RolePermissionController::class, 'updatePermissions'])->name('role-permissions-id.update');

        Route::resource('user-permissions', UserPermissionController::class);
        Route::post('users/{user}/permissions', [UserPermissionController::class, 'updatePermissions'])
            ->name('user-permissions-id.update');


        Route::prefix('lead')->group(function () {
            Route::get('/', [LeadController::class, 'index'])->name('lead.index');
            Route::get('/create', [LeadController::class, 'create'])->name('lead.create');
            Route::post('/store', [LeadController::class, 'store'])->name('lead.store');
            Route::get('/edit/{lead}', [LeadController::class, 'edit'])->name('lead.edit');
            Route::put('/update/{lead}', [LeadController::class, 'update'])->name('lead.update');
            // Route::delete('/destroy/{lead}', [LeadController::class, 'destroy'])->name('lead.destroy');
            Route::put('/bucket/{lead}', [LeadController::class, 'updateBucket'])->name('lead.updateBucket');

            Route::put('/status/{lead}', [LeadController::class, 'updateStatus'])->name('lead.updateStatus');
            Route::get('/history/{lead}', [LeadController::class, 'history'])->name('lead.history');
            Route::post('/send-message', [LeadController::class, 'sendMessage'])->name('lead.sendMessage');
            Route::get('/daily-report', [LeadController::class, 'dailyReport'])->name('lead.dailyReport');
            Route::put('/{lead}/engagement-status', [LeadController::class, 'updateEngagementStatus'])->name('lead.updateEngagementStatus');
            // Route::get('?bucket_id=15', [LeadController::class, 'index'])->name('lead.application');
            Route::get('/application', [LeadController::class, 'application'])->name('lead.application');
        });

        Route::prefix('bucket')->group(function () {
            Route::get('/', [BucketController::class, 'index'])->name('bucket.index');
            Route::post('/store', [BucketController::class, 'store'])->name('bucket.store');
            Route::get('/edit/{id}', [BucketController::class, 'edit'])->name('bucket.edit');
            Route::put('/update/{bucket}', [BucketController::class, 'update'])->name('bucket.update');
            Route::delete('/destroy/{bucket}', [BucketController::class, 'destroy'])->name('bucket.destroy');
        });

        Route::prefix('lead-questions')->group(function () {
            Route::get('/', [LeadQuestionController::class, 'index'])->name('lead_questions.index');
            Route::post('/store', [LeadQuestionController::class, 'store'])->name('lead_questions.store');
            Route::put('/update/{question}', [LeadQuestionController::class, 'update'])->name('lead_questions.update');
            Route::delete('/destroy/{question}', [LeadQuestionController::class, 'destroy'])->name('lead_questions.destroy');
            Route::put('/toggle/{question}', [LeadQuestionController::class, 'toggle'])->name('lead_questions.toggle'); // enable/disable
        });

        Route::prefix('lead-sources')->group(function () {
            Route::get('/', [LeadSourceController::class, 'index'])->name('lead_sources.index');
            Route::post('/store', [LeadSourceController::class, 'store'])->name('lead_sources.store');
            Route::put('/update/{source}', [LeadSourceController::class, 'update'])->name('lead_sources.update');
            Route::put('/toggle/{source}', [LeadSourceController::class, 'toggle'])->name('lead_sources.toggle');
        });

        Route::prefix('crm-blog')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('blog.index');
            Route::get('/create', [BlogController::class, 'create'])->name('blog.create');
            Route::post('/store', [BlogController::class, 'store'])->name('blog.store');
            Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
            Route::put('/update/{id}', [BlogController::class, 'update'])->name('blog.update');
            Route::delete('/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
        });
        Route::prefix('author')->name('author.')->group(function () {
            Route::get('/', [BlogController::class, 'blogAuthor'])->name('index');
            Route::post('/store', [BlogController::class, 'authorstore'])->name('store');
            Route::get('/edit/{id}', [BlogController::class, 'authorEdit'])->name('edit');
            Route::delete('/destroy/{id}', [BlogController::class, 'authorDestroy'])->name('destroy');
        });
        Route::prefix('warr-leads')->group(function () {
            Route::get('/', [WarrLeadController::class, 'index'])->name('warr-leads.index');
            Route::put('/{lead}', [WarrLeadController::class, 'update'])->name('warr-leads.updateWarrLead');
        });
        Route::prefix('warr-service-pages')->group(function () {
            Route::get('/', [WarrServicePageController::class, 'index'])->name('warr-service-pages.index');
            Route::get('/create', [WarrServicePageController::class, 'create'])->name('warr-service-pages.create');
            Route::post('/store', [WarrServicePageController::class, 'store'])->name('warr-service-pages.store');
            Route::get('/edit/{id}', [WarrServicePageController::class, 'edit'])->name('warr-service-pages.edit');
            Route::post('/update/{id}', [WarrServicePageController::class, 'update'])->name('warr-service-pages.update');
            Route::delete('/delete/{id}', [WarrServicePageController::class, 'destroy'])->name('warr-service-pages.delete');

            Route::get('/cities', [WarrServicePageController::class, 'getCities'])->name('warr-service-pages.cities');
        });

        Route::prefix('warr-crud')->group(function () {
            Route::get('/countries', [WarrServicePageController::class, 'countriesIndex'])->name('warr-countries.index');
            Route::post('/countries', [WarrServicePageController::class, 'countriesStore'])->name('warr-countries.store');
            Route::delete('/countries/{id}', [WarrServicePageController::class, 'countriesDestroy'])->name('warr-countries.destroy');

            Route::get('/cities', [WarrServicePageController::class, 'citiesIndex'])->name('warr-cities.index');
            Route::post('/cities', [WarrServicePageController::class, 'citiesStore'])->name('warr-cities.store');
            Route::delete('/cities/{id}', [WarrServicePageController::class, 'citiesDestroy'])->name('warr-cities.destroy');

            Route::get('/services', [WarrServicePageController::class, 'servicesIndex'])->name('warr-services.index');
            Route::post('/services', [WarrServicePageController::class, 'servicesStore'])->name('warr-services.store');
            Route::delete('/services/{id}', [WarrServicePageController::class, 'servicesDestroy'])->name('warr-services.destroy');
        });

        Route::prefix('crm-subject-pages')->group(function () {
            Route::get('/', [SubjectPageController::class, 'index'])->name('crm-subject-pages.index');
            Route::get('/create', [SubjectPageController::class, 'create'])->name('crm-subject-pages.create');
            Route::post('/store', [SubjectPageController::class, 'store'])->name('crm-subject-pages.store');
            Route::get('/edit/{id}', [SubjectPageController::class, 'edit'])->name('crm-subject-pages.edit');
            Route::put('/update/{id}', [SubjectPageController::class, 'update'])->name('crm-subject-pages.update');
            Route::delete('/destroy/{id}', [SubjectPageController::class, 'destroy'])->name('crm-subject-pages.destroy');
        });

        // Orders Route
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    });

    Route::post('/crm/leads/import', [LeadController::class, 'import'])->name('lead.import');
    Route::get('/crm/leads/sample', [LeadController::class, 'downloadSample'])->name('lead.sample');
    Route::get('/lead-import-status/{jobId}', [LeadController::class, 'getImportJobStatus']);

    // Modern Leads
    Route::get('/modern-leads', [NewleadController::class, 'index'])->name('modern.leads.index');
    Route::post('/modern-leads/convert', [NewleadController::class, 'bulkConvert'])->name('modern.leads.convert');
    Route::post('/modern-leads/drag-update/{lead}', [NewleadController::class, 'dragUpdate'])->name('lead.dragUpdate');
    Route::post('/modern-leads/quick-update/{lead}', [NewleadController::class, 'updateQuick'])->name('lead.updateQuick');
    Route::post('/modern-leads/todo/{lead}', [NewleadController::class, 'storeTodo'])->name('lead.storeTodo');
    Route::get('/document/view', [NewleadController::class, 'viewDocument'])->name('document.view');
    Route::get('/document/download', [NewleadController::class, 'downloadDocument'])->name('document.download');
    Route::get('/user/activity', [UserController::class, 'activity'])->name('user.activity');
    Route::post('/save-work-time', [UserController::class, 'saveWorkTime'])->name('save.work.time');
    Route::post('lead/bucket/get-sub-status', [LeadController::class, 'getSubStatus'])->name('lead.getSubStatus');

    Route::get('/follow-up-data', [LeadController::class, 'followUpData'])->name('lead.followUpData');
    Route::post('/callback-update/{id}', [LeadController::class, 'callbackUpdate'])->name('lead.callbackUpdate');
    Route::post('/callback-done', [LeadController::class, 'callbackDone'])->name('lead.callbackDone');
    Route::get('/lead/new-daily-report', [LeadController::class, 'newdailyReport'])->name('lead.newdailyReport');

    Route::get('/campaign-performance', [LeadController::class, 'campaignPerformance'])->name('lead.campaignPerformance');
    Route::get('/source', [LeadController::class, 'sourcePerformance'])->name('lead.sourcePerformance');
    Route::get('/lead/counsellor-report', [LeadController::class, 'councillorReport'])->name('lead.councillorReport');
    Route::get('/fetch-templates', [LeadController::class, 'fetchTemplates'])->name('lead.fetchTemplates');
    Route::post('/send-sms', [LeadController::class, 'sendSMS'])->name('lead.sendSms');
    Route::post('/leads/bulk-delete', [LeadController::class, 'bulkDelete'])->name('leads.bulkDelete');
    Route::patch('/user/{id}/status', [UserController::class, 'updateStatus'])
        ->name('users.userUpdateStatus');

    Route::get('/leads-export', [LeadController::class, 'exportLeads'])
        ->name('leads.export');

    Route::get('/lead/activity', [LeadController::class, 'leadActivity'])->name('lead.leadActivity');

    Route::get('/leads/export', [LeadController::class, 'export'])->name('lead.export');

    Route::get('/user/search-by-mobile', [LeadController::class, 'searchByMobile'])->name('user.search.byMobile');

    Route::prefix('university-details')->name('university-details.')->group(function () {
        Route::get('/', [UniversityDetailController::class, 'index'])->name('index');
        Route::get('/create', [UniversityDetailController::class, 'create'])->name('create');
        Route::post('/store-new', [UniversityDetailController::class, 'storeNew'])->name('store-new');
        Route::get('/edit/{universityId}', [UniversityDetailController::class, 'edit'])->name('edit');
        Route::post('/store/{universityId}', [UniversityDetailController::class, 'store'])->name('store');
        Route::put('/update-status/{universityId}', [UniversityDetailController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/destroy/{universityId}', [UniversityDetailController::class, 'destroy'])->name('destroy');
        Route::get('/preview/{universityId}', [UniversityDetailController::class, 'preview'])->name('preview');
        Route::post('/add-course', [UniversityDetailController::class, 'addCourse'])->name('add-course');
        Route::post('/update-course/{id}', [UniversityDetailController::class, 'updateCourse'])->name('update-course');
        Route::delete('/delete-course/{id}', [UniversityDetailController::class, 'deleteCourse'])->name('delete-course');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.passwprdUpdate');
});

Route::get('/', fn() => redirect()->route('dashboard'))->name('home');


require __DIR__ . '/auth.php';
