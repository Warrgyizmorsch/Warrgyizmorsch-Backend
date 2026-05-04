<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class DuolingoPageController extends Controller
{
    public function index($city)
    {
        // normalize incoming city (space → dash)
        $originalCity = $city;
        $city = strtolower(trim($city));
        $city = preg_replace('/\s+/', '-', $city);

        // auto redirect if user enters space based url
        if ($originalCity !== $city) {
            return redirect()->to(url('/duolingo/' . $city));
        }

        $cities = [
             "mumbai",
             "delhi",
             "bengaluru",
             "hyderabad",
             "chennai",
             "pune",
             "kolkata",
             "ahmedabad",
             "chandigarh",
             "noida",
             "gurugram",
             "jaipur",
             "kochi",
             "coimbatore",
             "indore",
             "bhopal",
             "surat",
             "vadodara",
             "nagpur",
             "dehradun",
             "lucknow",
             "kanpur",
             "varanasi",
             "patna",
             "ranchi",
             "guwahati",
             "vizag (visakhapatnam)",
             "vijayawada",
             "trivandrum",
             "trichy",
             "abohar",
             "adimali",
             "adoor",
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
             "bhubaneswar",
             "bhuj",
             "bikaner",
             "borivali mumbai",
             "btm layout bangalore",
             "budhlada",
             "calicut",
             "chalakudy",
             "changanacherry",
             "chembur mumbai",
             "chengannur",
             "cherthala",
             "chinchwad",
             "cuddalore",
             "dabwali",
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
             "gwalior",
             "hadapsar pune",
             "haldwani",
             "hanumangarh",
             "haridwar",
             "hazratganj lucknow",
             "hsr layout bangalore",
             "hubli",
             "indira nagar bangalore",
             "indiranagar bangalore",
             "indirapuram",
             "indirapuram ghaziabad",
             "jabalpur",
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
             "kolhapur",
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
             "muzaffarnagar",
             "nadiad",
             "nagercoil",
             "nakodar",
             "namakkal",
             "nangal",
             "naroda ahmedabad",
             "navsari",
             "nellore",
             "nungambakkam chennai",
             "ongole",
             "palakkad",
             "palanpur",
             "paschim vihar delhi",
             "pathanamthitta",
             "patiala",
             "payyanur",
             "pehowa",
             "phagwara",
             "phillaur",
             "pimpri chinchwad",
             "pinjore",
             "pondicherry",
             "porbandar",
             "preet vihar delhi",
             "raikot",
             "raipur",
             "rajahmundry",
             "rajpura",
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
             "surendranagar",
             "t nagar chennai",
             "thanjavur",
             "thiruvalla",
             "thodupuzha",
             "thrissur",
             "tirunelveli",
             "tirupur",
             "tohana",
             "tuticorin",
             "vadakara",
             "valsad",
             "vapi",
             "vastrapur ahmedabad",
             "vellore",
             "visakhapatnam",
             "visnagar",
             "vivek vihar delhi",
             "warangal",
             "wayanad",
             "west delhi",
             "whitefield bangalore",
             "zira",
             "udaipur",
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
            'duolingo-practice-test-guide-for-study-abroad',
            'ultimate-duolingo-english-test-preparation-tips-to-score-high',
            'duolingo-online-complete-guide-to-test-preparation-and-benefits',
            'duolingo-test-score-guide-for-students',
            'duolingo-exam-fees-full-breakdown-of-charges-rescheduling',
        ];

        $blogs = Blog::whereIn('slug', $slugs)->get();

        $cityName = ucwords(str_replace('-', ' ', $city));
        $citySlug = strtolower($city);

        $meta = [
            'title' => "Best DUOLINGO Coaching Centre in {$cityName} | WTS Study Abroad",
            'description' => "Looking for DUOLINGO coaching in {$cityName}? Join WTS, a trusted DUOLINGO coaching centre with expert trainers, mock tests, proven strategies and focus on 100+ scores.",
            'keywords' => ''
        ];

        return view('exam.duolingo', compact(
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
            'duolingo-practice-test-guide-for-study-abroad',
            'ultimate-duolingo-english-test-preparation-tips-to-score-high',
            'duolingo-online-complete-guide-to-test-preparation-and-benefits',
            'duolingo-test-score-guide-for-students',
            'duolingo-exam-fees-full-breakdown-of-charges-rescheduling',
        ];
        
    $blogs = Blog::whereIn('slug', $slugs)->get();

   $meta = [
            'title' => "Best DUOLINGO Coaching Centre | WTS Study Abroad",
            'description' => "Looking for DUOLINGO coaching? Join WTS, a trusted DUOLINGO coaching centre with expert trainers, mock tests, proven strategies and focus on 100+ scores.",
            'keywords' => ''
        ];

    return view('testpreparation.duolingoexam', compact(
        'blogs',
        'meta'
    ));
}
}
