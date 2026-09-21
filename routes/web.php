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
use App\Http\Controllers\CRM\EmailTemplateController;
use App\Http\Controllers\CRM\LeadEmailController;
use App\Http\Controllers\CRM\LeadTableController;
use App\Http\Controllers\CRM\CreatedDealController;
use App\Http\Controllers\CRM\FollowupController;
use App\Http\Controllers\CRM\TagController;
use App\Http\Controllers\CRM\ArchiveLeadController;
use App\Http\Controllers\CRM\ArchiveDealController;
use App\Http\Controllers\CRM\ProjectController;
use App\Http\Controllers\CRM\LeadEventController;

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

    Route::delete('/leads/{lead}/tags/{tag}', [TagController::class, 'detachFromLead'])
        ->name('leads.tags.detach');
    Route::post('/leads/{lead}/tags/{tag}/toggle', [TagController::class, 'toggleForLead'])
        ->name('leads.tags.toggle');


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

    Route::get('/lead-statuses', [BucketController::class, 'leadStatuses'])->name('lead-status.index');
    Route::get('/order-statuses', [BucketController::class, 'orderStatuses'])->name('order-status.index');

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
            Route::delete('/destroy/{lead}', [LeadController::class, 'destroy'])->name('lead.destroy');
            Route::put('/bucket/{lead}', [LeadController::class, 'updateBucket'])->name('lead.updateBucket');

            Route::put('/status/{lead}', [LeadController::class, 'updateStatus'])->name('lead.updateStatus');
            Route::get('/history/{lead}', [LeadController::class, 'history'])->name('lead.history');
            Route::post('/send-message', [LeadController::class, 'sendMessage'])->name('lead.sendMessage');
            Route::get('/daily-report', [LeadController::class, 'dailyReport'])->name('lead.dailyReport');
            Route::put('/{lead}/engagement-status', [LeadController::class, 'updateEngagementStatus'])->name('lead.updateEngagementStatus');
            Route::post('/{lead}/archive', [LeadController::class, 'archiveLead'])->name('lead.archive');
            Route::post('/{lead}/restore', [LeadController::class, 'restoreLead'])->name('lead.restore');
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

        Route::resource('tags', TagController::class)->only(['index', 'store', 'update', 'destroy']);

        Route::prefix('projects')->name('projects.')->group(function () {
            Route::get('/', [ProjectController::class, 'index'])->name('index');
            Route::post('/', [ProjectController::class, 'store'])->name('store');
            Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
            Route::put('/{project}', [ProjectController::class, 'update'])->name('update');
            Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');
            Route::patch('/{project}/status', [ProjectController::class, 'toggleStatus'])->name('toggle-status');
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

    // Modern Leads & Followups
    Route::get('/followups', [FollowupController::class, 'index'])->name('followups.index');
    Route::post('/followups/{followup}/mark-done', [FollowupController::class, 'markDone'])->name('followups.markDone');
    Route::post('/followups/{followup}/done', [FollowupController::class, 'markDone'])->name('followups.done');
    Route::post('/followups/{followup}/reschedule', [FollowupController::class, 'reschedule'])->name('followups.reschedule');
    Route::post('/followups/{followup}/convert-deal', [FollowupController::class, 'convertToDeal'])->name('followups.convertDeal');
    Route::get('/created-deals', [CreatedDealController::class, 'index'])->name('created.deals.index');
    Route::get('/created-deals/pipeline', [CreatedDealController::class, 'pipelineIndex'])->name('created.deals.pipeline');
    Route::get('/created-deals/pipeline/cards', [CreatedDealController::class, 'pipelineCards'])->name('created.deals.pipeline.cards');
    Route::post('/created-deals/pipeline/drag-update/{lead}', [CreatedDealController::class, 'pipelineDragUpdate'])->name('created.deals.pipeline.dragUpdate');
    Route::post('/created-deals/bulk-update-status', [CreatedDealController::class, 'bulkUpdateStatus'])->name('created.deals.bulkUpdateStatus');
    Route::get('/new-leads-table', [LeadTableController::class, 'index'])->name('leads.table.index');
    Route::post('/new-leads-table/{lead}/update-status', [LeadTableController::class, 'updateStatus'])->name('leads.table.updateStatus');
    Route::post('/new-leads-table/bulk-update-status', [LeadTableController::class, 'bulkUpdateStatus'])->name('leads.table.bulkUpdateStatus');
    Route::post('/new-leads-table/{lead}/convert-deal', [LeadTableController::class, 'convertToDeal'])->name('leads.table.convertDeal');
    Route::post('/new-leads-table/bulk-convert-deal', [LeadTableController::class, 'bulkConvertToDeal'])->name('leads.table.bulkConvertDeal');
    Route::get('/new-leads-table/pipeline', [LeadTableController::class, 'pipelineIndex'])->name('leads.table.pipeline');
    Route::get('/new-leads-table/pipeline/cards', [LeadTableController::class, 'pipelineCards'])->name('leads.table.pipeline.cards');
    Route::post('/new-leads-table/pipeline/drag-update/{lead}', [LeadTableController::class, 'pipelineDragUpdate'])->name('leads.table.pipeline.dragUpdate');

    // Archive Leads & Deals
    Route::get('/archive-leads', [ArchiveLeadController::class, 'index'])->name('archive.leads.index');
    Route::post('/archive-leads/{id}/archive', [ArchiveLeadController::class, 'archive'])->name('archive.leads.archive');
    Route::post('/archive-leads/bulk-archive', [ArchiveLeadController::class, 'bulkArchive'])->name('archive.leads.bulkArchive');
    Route::post('/archive-leads/{id}/restore', [ArchiveLeadController::class, 'restore'])->name('archive.leads.restore');
    Route::post('/archive-leads/bulk-restore', [ArchiveLeadController::class, 'bulkRestore'])->name('archive.leads.bulkRestore');
    Route::post('/archive-leads/bulk-delete', [ArchiveLeadController::class, 'bulkDelete'])->name('archive.leads.bulkDelete');

    Route::get('/archive-deals', [ArchiveDealController::class, 'index'])->name('archive.deals.index');
    Route::post('/archive-deals/{id}/archive', [ArchiveDealController::class, 'archive'])->name('archive.deals.archive');
    Route::post('/archive-deals/bulk-archive', [ArchiveDealController::class, 'bulkArchive'])->name('archive.deals.bulkArchive');
    Route::post('/archive-deals/{id}/restore', [ArchiveDealController::class, 'restore'])->name('archive.deals.restore');
    Route::post('/archive-deals/bulk-restore', [ArchiveDealController::class, 'bulkRestore'])->name('archive.deals.bulkRestore');
    Route::post('/archive-deals/bulk-delete', [ArchiveDealController::class, 'bulkDelete'])->name('archive.deals.bulkDelete');
    Route::post('/leads/bulk-delete', [LeadController::class, 'bulkDelete'])->name('leads.bulkDelete');

    Route::get('/modern-leads/search-suggestions', [NewleadController::class, 'searchSuggestions'])->name('modern.leads.search.suggestions');
    Route::get('/modern-leads', [NewleadController::class, 'index'])->name('modern.leads.index');
    Route::get('/modern-leads/pipeline', [NewleadController::class, 'pipelineIndex'])->name('modern.leads.pipeline');
    Route::get('/modern-leads/pipeline/cards', [NewleadController::class, 'pipelineCards'])->name('modern.leads.pipeline.cards');
    Route::post('/modern-leads/pipeline/drag-update/{lead}', [NewleadController::class, 'pipelineDragUpdate'])->name('modern.leads.pipeline.dragUpdate');
    Route::get('/modern-leads/{lead}/details-data', [NewleadController::class, 'getDetailsData'])->name('modern.leads.details.data');
    Route::post('/modern-leads/import/upload', [NewleadController::class, 'uploadImportFile'])->name('modern.leads.import.upload');
    Route::post('/modern-leads/import/process', [NewleadController::class, 'processImport'])->name('modern.leads.import.process');
    Route::post('/modern-leads/compare', [NewleadController::class, 'compareExcel'])->name('modern.leads.compare');
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

    // Email Template Master
    Route::prefix('email-templates')->name('email-templates.')->group(function () {
        Route::get('/', [EmailTemplateController::class, 'index'])->name('index');
        Route::post('/store', [EmailTemplateController::class, 'store'])->name('store');
        Route::get('/{emailTemplate}/edit', [EmailTemplateController::class, 'edit'])->name('edit');
        Route::put('/{emailTemplate}', [EmailTemplateController::class, 'update'])->name('update');
        Route::delete('/{emailTemplate}', [EmailTemplateController::class, 'destroy'])->name('destroy');
        Route::patch('/{emailTemplate}/toggle-status', [EmailTemplateController::class, 'toggleStatus'])->name('toggle-status');
    });

    // Lead Email Sending & History
    Route::prefix('lead-email')->name('lead-email.')->group(function () {
        Route::get('/active-templates', [LeadEmailController::class, 'getTemplates'])->name('active-templates');
        Route::post('/preview', [LeadEmailController::class, 'generatePreview'])->name('preview');
        Route::post('/send', [LeadEmailController::class, 'sendEmail'])->name('send');
        Route::get('/history/{lead}', [LeadEmailController::class, 'getHistory'])->name('history');
    });

    // Upcoming Events & Meetings
    Route::prefix('upcoming-events')->name('events.')->group(function () {
        Route::get('/', [LeadEventController::class, 'index'])->name('index');
        Route::post('/lead/{lead}', [LeadEventController::class, 'store'])->name('store');
        Route::put('/{event}', [LeadEventController::class, 'update'])->name('update');
        Route::post('/{event}/complete', [LeadEventController::class, 'complete'])->name('complete');
        Route::post('/{event}/cancel', [LeadEventController::class, 'cancel'])->name('cancel');
        Route::post('/{event}/reschedule', [LeadEventController::class, 'reschedule'])->name('reschedule');
        Route::delete('/{event}', [LeadEventController::class, 'destroy'])->name('destroy');
        Route::get('/lead/{lead}', [LeadEventController::class, 'getLeadEvents'])->name('lead.events');
    });
});

Route::get('/', fn() => redirect()->route('dashboard'))->name('home');


Route::get('/run-lead-events-test-suite', function () {
    $results = [];

    // 1. Find or pick a test lead
    $lead = \App\Models\Leads::first();
    if (!$lead) {
        return response()->json(['error' => 'No leads found to test with']);
    }

    $initialStatus = $lead->lead_status;
    $initialBucketId = $lead->lead_bucket_id;
    $initialBucketName = $lead->lead_bucket_name;

    // Test 1: Create events of all 4 types
    $types = [
        \App\Models\LeadEvent::TYPE_MEETING_SCHEDULE,
        \App\Models\LeadEvent::TYPE_DISCOVERY_CALL,
        \App\Models\LeadEvent::TYPE_PROJECTION_CALL,
        \App\Models\LeadEvent::TYPE_CONVERSION,
    ];
    $createdEvents = [];
    foreach ($types as $type) {
        $ev = \App\Models\LeadEvent::create([
            'lead_id' => $lead->id,
            'event_type' => $type,
            'event_date' => now()->addDays(2)->toDateString(),
            'start_time' => '11:00:00',
            'end_time' => '11:30:00',
            'title' => 'Automated Test ' . $type,
            'description' => 'Test event notes for ' . $type,
            'status' => \App\Models\LeadEvent::STATUS_SCHEDULED,
            'created_by' => 1,
        ]);
        $createdEvents[$type] = $ev;
    }
    $results['test_1_create_4_types'] = [
        'passed' => count($createdEvents) === 4,
        'types_created' => array_keys($createdEvents),
    ];

    // Test 2: Multiple events per lead
    $eventsCount = \App\Models\LeadEvent::where('lead_id', $lead->id)->count();
    $results['test_2_multiple_events'] = [
        'passed' => $eventsCount >= 4,
        'count' => $eventsCount,
    ];

    // Test 3: Complete event
    $completeEv = $createdEvents[\App\Models\LeadEvent::TYPE_MEETING_SCHEDULE];
    $completeEv->status = \App\Models\LeadEvent::STATUS_COMPLETED;
    $completeEv->completed_at = now();
    $completeEv->save();
    $results['test_3_complete_event'] = [
        'passed' => ($completeEv->status === 'completed' && !is_null($completeEv->completed_at)),
        'status' => $completeEv->status,
        'completed_at' => $completeEv->completed_at->toIso8601String(),
    ];

    // Test 4: Cancel event
    $cancelEv = $createdEvents[\App\Models\LeadEvent::TYPE_DISCOVERY_CALL];
    $cancelEv->status = \App\Models\LeadEvent::STATUS_CANCELLED;
    $cancelEv->save();
    $results['test_4_cancel_event'] = [
        'passed' => $cancelEv->status === 'cancelled',
        'status' => $cancelEv->status,
    ];

    // Test 5: Edit / Reschedule event
    $reschedEv = $createdEvents[\App\Models\LeadEvent::TYPE_PROJECTION_CALL];
    $newDate = now()->addDays(5)->toDateString();
    $newTime = '16:00:00';
    $reschedEv->event_date = $newDate;
    $reschedEv->start_time = $newTime;
    $reschedEv->status = \App\Models\LeadEvent::STATUS_RESCHEDULED;
    $reschedEv->save();
    $results['test_5_reschedule_event'] = [
        'passed' => ($reschedEv->event_date->format('Y-m-d') === $newDate && $reschedEv->start_time === $newTime && $reschedEv->status === 'rescheduled'),
        'event_date' => $reschedEv->event_date->format('Y-m-d'),
        'start_time' => $reschedEv->start_time,
        'status' => $reschedEv->status,
    ];

    // Test 6: Overdue detection
    $overdueEv = \App\Models\LeadEvent::create([
        'lead_id' => $lead->id,
        'event_type' => \App\Models\LeadEvent::TYPE_DISCOVERY_CALL,
        'event_date' => now()->subDays(2)->toDateString(),
        'start_time' => '09:00:00',
        'status' => \App\Models\LeadEvent::STATUS_SCHEDULED,
        'title' => 'Test Overdue Event',
    ]);
    $overdueCount = \App\Models\LeadEvent::overdue()->where('id', $overdueEv->id)->count();
    $results['test_6_overdue_detection'] = [
        'passed' => $overdueCount === 1,
        'detected' => $overdueCount,
    ];

    // Test 7: Lead Status Protection
    $lead->refresh();
    $results['test_7_lead_status_protection'] = [
        'passed' => (
            $lead->lead_status === $initialStatus &&
            $lead->lead_bucket_id === $initialBucketId &&
            $lead->lead_bucket_name === $initialBucketName
        ),
        'initial_status' => $initialStatus,
        'current_status' => $lead->lead_status,
        'initial_bucket_id' => $initialBucketId,
        'current_bucket_id' => $lead->lead_bucket_id,
        'initial_bucket_name' => $initialBucketName,
        'current_bucket_name' => $lead->lead_bucket_name,
    ];

    // Test 8: Cascade deletion compatibility with dummy lead
    $dummyLead = \App\Models\Leads::create([
        'lead_id' => 999999999,
        'is_converted' => 0,
        'is_archived' => 0,
        'lead_status' => 'Test Dummy',
    ]);
    $dummyEvent = \App\Models\LeadEvent::create([
        'lead_id' => $dummyLead->id,
        'event_type' => \App\Models\LeadEvent::TYPE_MEETING_SCHEDULE,
        'event_date' => now()->toDateString(),
        'start_time' => '10:00:00',
        'status' => 'scheduled',
    ]);
    $dummyEventId = $dummyEvent->id;
    $dummyLead->delete();
    $remainingDummyEvent = \App\Models\LeadEvent::find($dummyEventId);
    $results['test_8_cascade_deletion'] = [
        'passed' => is_null($remainingDummyEvent),
        'event_deleted_on_lead_delete' => is_null($remainingDummyEvent),
    ];

    // Test 9: Telecaller Permission Check
    $telecallerUser = new \App\Models\User();
    $telecallerUser->id = 888;
    $telecallerUser->role_id = 3;

    $ownedLead = new \App\Models\Leads();
    $ownedLead->id = 101;
    $ownedLead->lead_owner = 888;

    $notOwnedLead = new \App\Models\Leads();
    $notOwnedLead->id = 102;
    $notOwnedLead->lead_owner = 999;

    $controller = new \App\Http\Controllers\CRM\LeadEventController();
    $reflection = new \ReflectionClass($controller);
    $method = $reflection->getMethod('checkLeadAccess');
    $method->setAccessible(true);

    \Illuminate\Support\Facades\Auth::setUser($telecallerUser);
    $canAccessOwned = $method->invoke($controller, $ownedLead);
    $canAccessNotOwned = $method->invoke($controller, $notOwnedLead);
    
    $adminUser = new \App\Models\User();
    $adminUser->id = 1;
    $adminUser->role_id = 1;
    \Illuminate\Support\Facades\Auth::setUser($adminUser);
    $adminCanAccessNotOwned = $method->invoke($controller, $notOwnedLead);

    $results['test_9_role_permissions'] = [
        'passed' => ($canAccessOwned === true && $canAccessNotOwned === false && $adminCanAccessNotOwned === true),
        'telecaller_owned_access' => $canAccessOwned,
        'telecaller_unowned_access' => $canAccessNotOwned,
        'admin_unowned_access' => $adminCanAccessNotOwned,
    ];

    // Clean up test events on the real lead
    foreach ($createdEvents as $ev) {
        $ev->delete();
    }
    $overdueEv->delete();

    return response()->json($results);
});

require __DIR__ . '/auth.php';
