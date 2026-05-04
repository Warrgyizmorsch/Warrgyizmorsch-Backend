<?php

use App\Http\Controllers\CRM\BlogController;
use App\Http\Controllers\CRM\SubjectPageController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ToeflPageController;
use App\Http\Controllers\PtePageController;
use App\Http\Controllers\GmatPageController;
use App\Http\Controllers\GrePageController;
use App\Http\Controllers\SatPageController;
use App\Http\Controllers\DuolingoPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\CRM\LeadController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\IeltsPageController;
use App\Models\Blog;
use App\Models\University;

Route::post('/apply-university', [UniversityController::class, 'apply'])->name('university.apply');

Route::get('/leads/export', [LeadController::class, 'export'])->name('lead.export');

Route::get('/user/search-by-mobile', [LeadController::class, 'searchByMobile'])->name('user.search.byMobile');

// Route::get('/', [UniversityController::class, 'filterUniversity'])->name('home');
Route::get('/', [UniversityController::class, 'newHome'])->name('home');

Route::get('/visa-consultation', [UniversityController::class, 'landingPage'])->name('landing_page');
Route::get('/uk-study-visa-consultation', [UniversityController::class, 'ukStudyVisaConsultation'])->name('landing_page2');
Route::get('/study-abroad-in-uk', [UniversityController::class, 'studyAbroadConsultant'])->name('study_abroad_consultant');
Route::get('/study-abroad-consultant-v1', [LandingPageController::class, 'studyAbroadConsultantV1'])->name('study_abroad_consultant_v1');
Route::post('/landing-page/submit', [LandingPageController::class, 'submitLead'])->name('landing.page.submit');
Route::post('/landing-page/send-otp', [LandingPageController::class, 'sendOtp'])->name('landing.page.send.otp');
Route::post('/landing-page/verify-otp', [LandingPageController::class, 'verifyOtp'])->name('landing.page.verify.otp');

Route::get('/contact', function () {
    return view("contact");
})->name('contact');

Route::get('/about', function () {
    return view("about");
})->name('about');
Route::get('/privacy-policy', function () {
    return view("privacy-policy");
})->name('privacy_policy');
Route::get('/terms-and-conditions', function () {
    return view("terms-of-service");
})->name('terms_of_service');



Route::get('/universities', [UniversityController::class, 'showByCountry'])->name('universities.index');
Route::get('/course-finder', [UniversityController::class, 'courseFinder'])->name('course.finder');
Route::post('/course-finder-submit', [UniversityController::class, 'courseFinderPageLeadToCrm'])->name('submit.lead.course.finder');

// Route::get('/fetch-currency-rates', [UniversityController::class, 'fetchAndStoreRates']);


// Route::post('/contact-submit', [MasterController::class, 'submit'])->name('contact.submit');

Route::get('/component-hero', [MasterController::class, 'hero'])->name('component-hero');


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});


Route::get('/services/sop-assistance', function () {
    return view('services.sop-assistance.index');
})->name('sop_assistance');

Route::get('/services/course-selection', function () {
    return view('services.course-selection.course-selection');
})->name('course_selection');

Route::get('/services/counseling-with-an-expert', function () {
    return view('services.counselling.counselling');
})->name('counseling_with_an_expert');

Route::get('/services/getting-admission', function () {
    return view('services.getting-admission.index');
})->name('getting_admission');

Route::get('/services/mock-interviews', function () {
    return view('services.mock.mock');
})->name('mock_interviews');

Route::get('/services/travel-arrangements', function () {
    return view('services.travelling.travel');
})->name('travel_arrangements');

Route::get('/services/visa-assistance', function () {
    return view('services.visa-assistance.visa');
})->name('visa_assistance');

Route::get('/services/free-profile-evaluation', function () {
    return view('services.free-profile-evaluation.free-profile-evaluation');
})->name('free_profile_evaluation');

Route::get('/services/education-loan', function () {
    return view('services.education-loan.education-loan');
})->name('education_loan');

Route::get('/services/post-landing-services', function () {
    return view('services.post-landing-services.post-landing');
})->name('post_landing');

Route::get('/services/scholarship-assistance', function () {
    return view('services.scholarship-assistance.scholarship');
})->name('scholarship');

Route::get('/services/test-preparation', function () {
    return view('services.test-preparation.test-preparation');
})->name('test_preparation');

// services routes end

// country routes start
Route::get('/country/europe', function () {
    return view('countries.europe');
})->name('europe');

Route::get('/country/study-in-uk', function () {
    $universities = University::where('country', 'united kingdom')
        ->orderByDesc('enroll_students')
        ->limit(10)
        ->get();

    // Data check karne ke liye (Debug)

    // echo '<pre>';
    // print_r($universities->toArray());
    // exit;

    return view('countries.uk', compact('universities'));
})->name('uk');

Route::get('/country/study-in-usa', function () {
    return view('countries.usa');
})->name('usa');

Route::get('/country/study-in-canada', function () {
    return view('countries.canada');
})->name('canada');

Route::get('/country/study-in-new-zealand', function () {
    return view('countries.newzealand');
})->name('new_zealand');

Route::get('/country/study-in-australia', function () {
    return view('countries.australia');
})->name('australia');

Route::get('/country/study-in-ireland', function () {
    return view('countries.ireland');
})->name('ireland');

Route::get('/country/study-in-france', function () {
    return view('countries.france');
})->name('france');

Route::get('/country/study-in-germany', function () {
    return view('countries.germany');
})->name('germany');

Route::get('/country/study-in-uae', function () {
    return view('countries.uae');
})->name('uae');

Route::get('/country/study-in-singapore', function () {
    return view('countries.singapore');
})->name('singapore');

Route::get('/country/study-in-switzerland', function () {
    return view('countries.switzerland');
})->name('switzerland');

Route::get('/country/study-in-spain', function () {
    return view('countries.spain');
})->name('spain');

Route::get('/country/study-in-netherlands', function () {
    return view('countries.netherlands');
})->name('netherlands');

Route::get('/country/study-in-italy', function () {
    return view('countries.italy');
})->name('italy');

Route::get('/country/study-in-finland', function () {
    return view('countries.finland');
})->name('finland');
Route::get('/country/study-in-poland', function () {
    return view('countries.poland');
})->name('poland');
Route::get('/country/study-in-russia', function () {
    return redirect('/');
})->name('russia');
Route::get('/country/study-in-sweden', function () {
    return view('countries.sweden');
})->name('sweden');
Route::get('/country/study-in-austria', function () {
    return view('countries.austria');
})->name('austria');
Route::get('/country/study-in-denmark', function () {
    return view('countries.denmark');
})->name('denmark');
Route::get('/country/study-in-norway', function () {
    return view('countries.norway');
})->name('norway');
Route::get('/country/study-in-cyprus', function () {
    return view('countries.cyprus');
})->name('cyprus');
Route::get('/country/study-in-latvia', function () {
    return view('countries.latvia');
})->name('latvia');
Route::get('/country/study-in-luxembourg', function () {
    return view('countries.luxembourg');
})->name('luxembourg');
Route::get('/country/study-in-malta', function () {
    return view('countries.malta');
})->name('malta');
Route::get('/country/study-in-georgia', function () {
    return view('countries.georgia');
})->name('georgia');
Route::get('/country/study-in-lithuania', function () {
    return view('countries.lithuania');
})->name('lithuania');
Route::get('/country/study-in-czech-republic', function () {
    return view('countries.czechrepublic');
})->name('czechrepublic');
Route::get('/country/study-in-hungary', function () {
    return view('countries.hungary');
})->name('hungary');
Route::get('/country/study-in-romania', function () {
    return view('countries.romania');
})->name('romania');
Route::get('/country/study-in-belgium', function () {
    return view('countries.belgium');
})->name('belgium');
Route::get('/country/study-in-estonia', function () {
    return view('countries.estonia');
})->name('estonia');
Route::get('/country/study-in-greece', function () {
    return view('countries.greece');
})->name('greece');
Route::get('/country/study-in-portugal', function () {
    return view('countries.portugal');
})->name('portugal');
Route::get('/country/study-in-slovenia', function () {
    return view('countries.slovenia');
})->name('slovenia');
Route::get('/country/study-in-iceland', function () {
    return view('countries.iceland');
})->name('iceland');
Route::get('/country/study-in-turkey', function () {
    return redirect('/');
})->name('turkey');
Route::get('/country/study-in-slovakia', function () {
    return view('countries.slovakia');
})->name('slovakia');
Route::get('/country/study-in-belarus', function () {
    return view('countries.belarus');
})->name('belarus');
Route::get('/country/study-in-bulgaria', function () {
    return view('countries.bulgaria');
})->name('bulgaria');
Route::get('/country/study-in-croatia', function () {
    return view('countries.croatia');
})->name('croatia');
Route::get('/country/study-in-kazakhstan', function () {
    return view('countries.kazakhstan');
})->name('kazakhstan');
Route::get('/country/study-in-monaco', function () {
    return view('countries.monaco');
})->name('monaco');
Route::get('/country/study-in-liechtenstein', function () {
    return view('countries.liechtenstein');
})->name('liechtenstein');
Route::get('/country/study-in-moldova', function () {
    return view('countries.moldova');
})->name('moldova');
Route::get('/country/study-in-serbia', function () {
    return view('countries.serbia');
})->name('serbia');
Route::get('/country/study-in-ukraine', function () {
    return view('countries.ukraine');
})->name('ukraine');
Route::get('/country/study-in-albania', function () {
    return view('countries.albania');
})->name('albania');
Route::get('/country/study-in-azerbaijan', function () {
    return view('countries.azerbaijan');
})->name('azerbaijan');
Route::get('/country/study-in-armenia', function () {
    return view('countries.armenia');
})->name('armenia');
Route::get('/country/study-in-bosnia', function () {
    return view('countries.bosnia');
})->name('bosnia');
Route::get('/country/study-in-andorra', function () {
    return view('countries.andorra');
})->name('andorra');
Route::get('/country/study-in-kosovo', function () {
    return view('countries.kosovo');
})->name('kosovo');
Route::get('/country/study-in-montenegro', function () {
    return view('countries.montenegro');
})->name('montenegro');
Route::get('/country/study-in-north-macedonia', function () {
    return view('countries.northmacedonia');
})->name('northmacedonia');
Route::get('/country/study-in-san-marino', function () {
    return view('countries.sanmarino');
})->name('sanmarino');
Route::get('/country/study-in-vatican-city', function () {
    return view('countries.vaticancity');
})->name('vaticancity');
Route::get('/country/study-in-saudi-arabia', function () {
    return redirect('/');
})->name('saudiarabia');
Route::get('/country/study-in-japan', function () {
    return view('countries.japan');
})->name('japan');
Route::get('/country/study-in-china', function () {
    return redirect('/');
})->name('china');
Route::get('/country/study-in-malaysia', function () {
    return redirect('/');
})->name('malaysia');
Route::get('/country/study-in-south-korea', function () {
    return redirect('/');
})->name('southkorea');
Route::get('/country/study-in-taiwan', function () {
    return redirect('/');
})->name('taiwan');
Route::get('/country/study-in-philippines', function () {
    return redirect('/');
})->name('philippines');
Route::get('/country/study-in-thailand', function () {
    return redirect('/');
})->name('thailand');
Route::get('/country/study-in-israel', function () {
    return redirect('/');
})->name('israel');
Route::get('/country/study-in-vietnam', function () {
    return redirect('/');
})->name('vietnam');
Route::get('/country/study-in-iran', function () {
    return redirect('/');
})->name('iran');
Route::get('/country/study-in-uzbekistan', function () {
    return redirect('/');
})->name('uzbekistan');
Route::get('/country/study-in-indonesia', function () {
    return redirect('/');
})->name('indonesia');
Route::get('/country/study-in-iraq', function () {
    return redirect('/');
})->name('iraq');
Route::get('/country/study-in-kuwait', function () {
    return redirect('/');
})->name('kuwait');
Route::get('/country/study-in-qatar', function () {
    return redirect('/');
})->name('qatar');
Route::get('/country/study-in-kyrgyzstan', function () {
    return redirect('/');
})->name('kyrgyzstan');
Route::get('/country/study-in-oman', function () {
    return redirect('/');
})->name('oman');

Route::get('/country/international', function () {
    return view('countries.international');
})->name('international');

// country routes end

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.passwprdUpdate');
});

Route::post('/submit-registration', [MailController::class, 'sendVisaAssistanceEmail'])->name('submit.registration');
Route::post('/submit-lead', [MailController::class, 'sendLeadToCrm'])->name('submit.lead');
Route::post('/submit-lead-landing-page', [MailController::class, 'sendLandingPageLeadToCrm'])->name('submit.lead.landing.page');
Route::post('/contact-submit', [MailController::class, 'contactSubmit'])->name('contact.submit');
Route::post('/send-otp', [MailController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [MailController::class, 'verifyOtp'])->name('verify.otp');
Route::get('/thankyou', function () {
    if (!session('visa_form_submitted')) {
        abort(404); // prevent direct access
    }

    // Forget the session so refresh won't keep working
    session()->forget('visa_form_submitted');

    return view('thankyou'); // adjust view path as needed
})->name('thankyou');

Route::get('/thank-you', function () {
    if (!session('visa_form_submitted')) {
        abort(404); // prevent direct access
    }

    // Forget the session so refresh won't keep working
    session()->forget('visa_form_submitted');

    return view('thankyou'); // adjust view path as needed
})->name('thank-you');

Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'getBlogBySlug']);
Route::get('/blog-sitemap', [BlogController::class, 'blogSitemap'])->name('blog-sitemap');
Route::get('/load-more-blogs', [BlogController::class, 'loadMore']);
Route::get('/search-blogs', [BlogController::class, 'searchBlogs']);

// city pages
Route::get('/study-abroad-consultants-in-{city}', [CityController::class, 'studyAbroad'])->name('city.studyabroad');

// education consultants - city pages
Route::get('/uk-education-consultants-in-{city}', [CityController::class, 'ukEducation'])->name('city.uk.education');
Route::get('/australia-education-consultants-in-{city}', [CityController::class, 'australiaEducation'])->name('city.australia.education');
Route::get('/france-education-consultants-in-{city}', [CityController::class, 'franceEducation'])->name('city.france.education');
Route::get('/new-zealand-education-consultants-in-{city}', [CityController::class, 'newZealandEducation'])->name('city.nz.education');
Route::get('/ireland-education-consultants-in-{city}', [CityController::class, 'irelandEducation'])->name('city.ireland.education');
Route::get('/canada-education-consultants-in-{city}', [CityController::class, 'canadaEducation'])->name('city.canada.education');
Route::get('/germany-education-consultants-in-{city}', [CityController::class, 'germanyEducation'])->name('city.germany.education');
Route::get('/usa-education-consultants-in-{city}', [CityController::class, 'usaEducation'])->name('city.usa.education');
Route::get('/dubai-education-consultants-in-{city}', [CityController::class, 'dubaiEducation'])->name('city.dubai.education');
Route::get('/switzerland-education-consultants-in-{city}', [CityController::class, 'switzerlandEducation'])->name('city.switzerland.education');
Route::get('/italy-education-consultants-in-{city}', [CityController::class, 'italyEducation'])->name('city.italy.education');
Route::get('/singapore-education-consultants-in-{city}', [CityController::class, 'singaporeEducation'])->name('city.singapore.education');
Route::get('/netherlands-study-abroad-consultants-in-{city}', [CityController::class, 'netherlandsEducation'])->name('city.netherlands.education');


Route::get('/study-abroad', function () {
    return view('informational.study-abroad');
})->name('study-abroad');

Route::get('/cost-of-living', function () {
    return view('informational.cost-of-living');
})->name('cost-of-living');

Route::get('/letter-of-recommendation', function () {
    return view('informational.letter-of-recommendation');
})->name('letter-of-recommendation');

Route::get('/ielts-training', function () {
    return view('informational.ielts-training');
})->name('ielts-training');

Route::get('/career-counseling', function () {
    return view('informational.career-counseling');
})->name('career-counseling');

Route::get('/study/{slug}', [SubjectPageController::class, 'getSubjectBySlug']);
Route::get('/study-sitemap', [SubjectPageController::class, 'subjectSitemap'])->name('subject-sitemap');

Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);


Route::get('/ielts-coaching-in-{city}', [IeltsPageController::class, 'index'])
    ->name('ielts.city');

Route::get('/toefl-coaching-in-{city}', [ToeflPageController::class, 'index'])
    ->name('toefl.city');

Route::get('/pte-coaching-in-{city}', [PtePageController::class, 'index'])
    ->name('pte.city');

Route::get('/gmat-coaching-in-{city}', [GmatPageController::class, 'index'])
    ->name('gmat.city');

Route::get('/gre-coaching-in-{city}', [GrePageController::class, 'index'])
    ->name('gre.city');

Route::get('/sat-coaching-in-{city}', [SatPageController::class, 'index'])
    ->name('sat.city');

Route::get('/duolingo-coaching-in-{city}', [DuolingoPageController::class, 'index'])
    ->name('duolingo.city');

// test
Route::get('/ielts-coaching', [IeltsPageController::class, 'test'])
    ->name('ielts.test');

Route::get('/toefl-coaching', [ToeflPageController::class, 'test'])
    ->name('toefl.test');
    
Route::get('/pte-coaching', [PtePageController::class, 'test'])
    ->name('pte.test');

Route::get('/gmat-coaching', [GmatPageController::class, 'test'])
    ->name('gmat.test');

Route::get('/gre-coaching', [GrePageController::class, 'test'])
    ->name('gre.test');

Route::get('/sat-coaching', [SatPageController::class, 'test'])
    ->name('sat.test');

Route::get('/duolingo-coaching', [DuolingoPageController::class, 'test'])
    ->name('duolingo.test');

// university details page route
Route::get('/universities/{country}/{slug}', [UniversityController::class, 'showUniversity'])
    ->name('university.show');

require __DIR__ . '/auth.php';
require __DIR__ . '/backend.php';