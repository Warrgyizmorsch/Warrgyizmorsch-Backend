<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class IeltsPageController extends Controller
{
    public function index($city)
    {
        // normalize incoming city (space → dash)
        $originalCity = $city;
        $city = strtolower(trim($city));
        $city = preg_replace('/\s+/', '-', $city);

        // auto redirect if user enters space based url
        if ($originalCity !== $city) {
            return redirect()->to(url('/ielts/' . $city));
        }

        $cities = [
            "udaipur",
            "abohar",
            "adimali",
            "adoor",
            "ahmedabad",
            "ahmedgarh",
            "ajmer",
            "aligarh",
            "amravati",
            "amreli",
            "andheri east mumbai",
            "andheri west mumbai",
            "angamaly",
            "ankleshwar",
            "anna nagar chennai",
            "attingal",
            "aurangabad",
            "baghapurana",
            "bahadurgarh",
            "bandra mumbai",
            "baner pune",
            "bangalore",
            "banjara hills hyderabad",
            "barnala",
            "bathery",
            "bharuch",
            "bhavnagar",
            "bhiwadi",
            "bhiwani",
            "bhopal",
            "bhubaneswar",
            "bhuj",
            "bikaner",
            "borivali mumbai",
            "btm layout bangalore",
            "budhlada",
            "calicut",
            "chalakudy",
            "chandigarh",
            "changanacherry",
            "chembur mumbai",
            "chengannur",
            "chennai",
            "cherthala",
            "chinchwad",
            "coimbatore",
            "cuddalore",
            "dabwali",
            "dehradun",
            "delhi",
            "derabassi",
            "dhuri",
            "dilshad garden delhi",
            "durgapur",
            "dwarka",
            "dwarka delhi",
            "eluru",
            "ernakulam",
            "erode",
            "fazilka",
            "ferozepur",
            "gachibowli hyderabad",
            "gandhidham",
            "gandhinagar",
            "ganganagar",
            "garhshankar",
            "ghaziabad",
            "goa",
            "godhra",
            "gohana",
            "goregaon mumbai",
            "guntur",
            "gurgaon",
            "guwahati",
            "gwalior",
            "hadapsar pune",
            "haldwani",
            "hanumangarh",
            "haridwar",
            "hazratganj lucknow",
            "hsr layout bangalore",
            "hubli",
            "hyderabad",
            "indira nagar bangalore",
            "indiranagar bangalore",
            "indirapuram",
            "indirapuram ghaziabad",
            "indore",
            "jabalpur",
            "jaipur",
            "jalandhar",
            "jamnagar",
            "jamshedpur",
            "jhansi",
            "jind",
            "jodhpur",
            "jp nagar bangalore",
            "jubilee hills hyderabad",
            "junagadh",
            "kaithal",
            "kakinada",
            "kalyan mumbai",
            "kalyan nagar bangalore",
            "kandivali mumbai",
            "kannur",
            "kanyakumari",
            "kapurthala",
            "karaikal",
            "karimnagar",
            "karnal",
            "kashipur",
            "katpadi",
            "kochi",
            "kolhapur",
            "kolkata",
            "kollam",
            "kondapur hyderabad",
            "koramangala bangalore",
            "kothrud pune",
            "kottakkal",
            "kottarakkara",
            "kottayam",
            "kozhikode",
            "kumbakonam",
            "kurnool",
            "laxmi nagar delhi",
            "lucknow",
            "ludhiana",
            "madurai",
            "malad mumbai",
            "malappuram",
            "malerkotla",
            "malout",
            "mangalore",
            "manipal",
            "manjeri",
            "mansa",
            "marthandam",
            "mathura",
            "mavelikara",
            "meerut",
            "mehsana",
            "moga",
            "morinda",
            "mukerian",
            "mukherjee nagar delhi",
            "muktsar",
            "mumbai",
            "muzaffarnagar",
            "nadiad",
            "nagercoil",
            "nakodar",
            "namakkal",
            "nangal",
            "naroda ahmedabad",
            "navsari",
            "nellore",
            "noida",
            "nungambakkam chennai",
            "ongole",
            "palakkad",
            "palanpur",
            "paschim vihar delhi",
            "pathanamthitta",
            "patiala",
            "patna",
            "payyanur",
            "pehowa",
            "phagwara",
            "phillaur",
            "pimpri chinchwad",
            "pinjore",
            "pondicherry",
            "porbandar",
            "preet vihar delhi",
            "pune",
            "raikot",
            "raipur",
            "rajahmundry",
            "rajpura",
            "ranchi",
            "ranip ahmedabad",
            "ratia",
            "rewari",
            "rishikesh",
            "roorkee",
            "rudrapur",
            "saharanpur",
            "sector 18 noida",
            "sector 19 chandigarh",
            "sector 7 panchkula",
            "secunderabad",
            "shillong",
            "shimla",
            "sikar",
            "siliguri",
            "silvassa",
            "sirhind",
            "srinagar",
            "sunam",
            "surat",
            "surendranagar",
            "t nagar chennai",
            "thanjavur",
            "thiruvalla",
            "thodupuzha",
            "thrissur",
            "tirunelveli",
            "tirupur",
            "tohana",
            "trichy",
            "trivandrum",
            "tuticorin",
            "vadakara",
            "valsad",
            "vapi",
            "vastrapur ahmedabad",
            "vellore",
            "vijayawada",
            "visakhapatnam",
            "visnagar",
            "vivek vihar delhi",
            "warangal",
            "wayanad",
            "west delhi",
            "whitefield bangalore",
            "zira",
            "vadodara",
            "jammu"
        ];

        // convert allowed cities into slug format
        $cities = array_map(function ($c) {
            return str_replace(' ', '-', $c);
        }, $cities);

        if (!in_array($city, $cities)) {
            abort(404);
        }

        $slugs = [
            'ielts-exam-format-explained-sections-pattern-scoring-system',
            'how-to-prepare-for-ielts-complete-step-by-step-preparation-guide',
            'ielts-exam-fees-complete-cost-breakdown-for-academic-general-tests',
            'uk-universities-without-ielts-complete-guide-for-international-students',
            'study-in-uk-without-ielts-for-indians-eligibility-options',
        ];

        $blogs = Blog::whereIn('slug', $slugs)->get();

        $cityName = ucwords(str_replace('-', ' ', $city));
        $citySlug = strtolower($city);

        $meta = [
            'title' => "Best IELTS Coaching Centre in {$cityName} | WTS Study Abroad",
            'description' => "Looking for IELTS coaching in {$cityName}? Join WTS, a top IELTS coaching centre in {$cityName} with proven results. Expert trainers, mocks & 9+ band focus. Book a Free Demo Class.",
            'keywords' => ''
        ];

        return view('exam.ielts', compact(
            'blogs',
            'cityName',
            'citySlug',
            'meta'
        ));
    }
    

    // Exam Test

    public function test()
{
    // Fixed blog slugs related to IELTS
    $slugs = [
        'ielts-exam-format-explained-sections-pattern-scoring-system',
        'how-to-prepare-for-ielts-complete-step-by-step-preparation-guide',
        'ielts-exam-fees-complete-cost-breakdown-for-academic-general-tests',
        'uk-universities-without-ielts-complete-guide-for-international-students',
        'study-in-uk-without-ielts-for-indians-eligibility-options',
    ];

    $blogs = Blog::whereIn('slug', $slugs)->get();

    $meta = [
        'title' => 'IELTS Coaching & Exam Preparation | WTS Study Abroad',
        'description' => 'Prepare for IELTS with WTS Study Abroad. Expert faculty, structured study plan, mock tests, and proven results to help you score Band 7+.',
        'keywords' => 'IELTS coaching, IELTS preparation, IELTS exam, IELTS classes'
    ];

    return view('testpreparation.ieltsexam', compact(
        'blogs',
        'meta'
    ));
}
}
