<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        // ---- STATIC PAGES WITH CUSTOM SETTINGS ----
        $staticPages = [
            [
                'url' => '/',
                'priority' => '1.00',
                'changefreq' => 'daily'
            ],

            // ----- SERVICE PAGES -----
            [
                'url' => '/services/course-selection',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/getting-admission',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/sop-assistance',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/visa-assistance',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/mock-interviews',
                'priority' => '0.80',
                'changefreq' => 'weekly'
            ],
            [
                'url' => '/services/travel-arrangements',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/free-profile-evaluation',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/education-loan',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/post-landing-services',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/counseling-with-an-expert',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/scholarship-assistance',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/services/test-preparation',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],

            // ----- COUNTRY PAGES -----
            [
                'url' => '/country/europe',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-usa',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-canada',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-new-zealand',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-australia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-uk',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/international',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-netherlands',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-singapore',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-italy',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-ireland',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-uae',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-spain',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-switzerland',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-france',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
             [
                'url' => '/country/study-in-germany',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-finland',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-poland',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-sweden',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            // [
            //     'url' => '/country/study-in-russia',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            [
                'url' => '/country/study-in-austria',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-denmark',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-norway',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-cyprus',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-latvia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-luxembourg',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-malta',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-georgia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-lithuania',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-czech-republic',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-hungary',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-romania',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-belgium',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-estonia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-greece',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-portugal',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-slovenia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-iceland',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            // [
            //     'url' => '/country/study-in-turkey',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            [
                'url' => '/country/study-in-slovakia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-belarus',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-bulgaria',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-croatia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-kazakhstan',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-monaco',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-liechtenstein',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-moldova',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-serbia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-ukraine',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-albania',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-azerbaijan',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-armenia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-bosnia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-andorra',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-kosovo',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-montenegro',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-north-macedonia',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-san-marino',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            [
                'url' => '/country/study-in-vatican-city',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            // [
            //     'url' => '/country/study-in-saudi-arabia',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            [
                'url' => '/country/study-in-japan',
                'priority' => '0.80',
                'changefreq' => 'daily'
            ],
            // [
            //     'url' => '/country/study-in-china',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-malaysia',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-south-korea',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-taiwan',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-philippines',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-thailand',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-israel',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-vietnam',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-iran',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-uzbekistan',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-indonesia',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-iraq',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-kuwait',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-qatar',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-kyrgyzstan',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            // [
            //     'url' => '/country/study-in-oman',
            //     'priority' => '0.80',
            //     'changefreq' => 'daily'
            // ],
            

            // ----- MAIN STATIC PAGES -----
            [
                'url' => '/about',
                'priority' => '0.80',
                'changefreq' => 'weekly'
            ],
            [
                'url' => '/contact',
                'priority' => '0.80',
                'changefreq' => 'weekly'
            ],
            [
                'url' => '/terms-and-conditions',
                'priority' => '0.80',
                'changefreq' => 'weekly'
            ],
            [
                'url' => '/privacy-policy',
                'priority' => '0.80',
                'changefreq' => 'weekly'
            ],

            // ----- INFORMATIONAL PAGES -----
            [
                'url' => '/study-abroad',
                'priority' => '0.85',
                'changefreq' => 'weekly'
            ],
            [
                'url' => '/cost-of-living',
                'priority' => '0.85',
                'changefreq' => 'weekly'
            ],
            [
                'url' => '/letter-of-recommendation',
                'priority' => '0.80',
                'changefreq' => 'weekly'
            ],
            [
                'url' => '/career-counseling',
                'priority' => '0.75',
                'changefreq' => 'monthly'
            ],
            [
                'url' => '/ielts-training',
                'priority' => '0.80',
                'changefreq' => 'weekly'
            ],
        ];

        // ---- CITY PAGES (DYNAMIC URL GENERATION) ----
        $cities = ['chennai', 'mumbai', 'delhi', 'bengaluru', 'hyderabad', 'kolkata', 'pune', 'ahmedabad', 'udaipur', 'jaipur', 'kochi', 'kerala', 'trivandrum', 'calicut', 'thrissur', 'coimbatore', 'indore', 'noida', 'kottayam', 'visakhapatnam', 'ernakulam', 'bhopal', 'chandigarh', 'gurgaon', 'lucknow', 'vadodara', 'vijayawada', 'dehradun', 'kollam', 'nagpur', 'surat', 'thane', 'kannur', 'mangalore', 'rajkot', 'nashik', 'amritsar', 'guntur', 'jalandhar', 'madurai', 'trichy', 'malappuram', 'alappuzha', 'bhubaneswar', 'dwarka', 'ghaziabad', 'guwahati', 'jammu', 'palakkad', 'patiala', 'pondicherry', 'faridabad', 'perinthalmanna', 'anand', 'gandhinagar', 'goa', 'kanpur', 'karnal', 'kurukshetra', 'mohali', 'mysore', 'kasaragod', 'nungambakkam', 'thodupuzha', 'ambala', 'aurangabad', 'bareilly', 'borivali', 'gwalior', 'haryana', 'kolhapur', 'patna', 'raipur', 'salem', 'janakpuri', 'kattappana', 'agra', 'hisar', 'jodhpur', 'tirupati', 'kothamangalam', 'namakkal', 'vashi', 'hubli', 'panchkula', 'rajahmundry', 'varanasi', 'moga', 'manjeri', 'mavelikara', 'andheri', 'tirunelveli', 'aligarh', 'bharuch', 'kadapa', 'sirsa', 'bhilwara', 'rajsamand', 'chittorgarh', 'jamnagar', 'palanpur', 'nadiad', 'bhavnagar', 'barmer', 'nagaur', 'balotra', 'sonipat', 'bahadurgarh', 'meerut', 'rohtak', 'panipat', 'ludhiana', 'bathinda', 'hoshiarpur', 'firozpur', 'sangrur', 'barnala', 'kapurthala', 'fatehgarh-sahib', 'anna-nagar-chennai','phagwara','erode','vellore','thanjavur','thoothukudi','kanchipuram','cuddalore','karur','hosur','nagercoil','sivakasi','villupuram','tiruppur','ramanathapuram','nagapattinam','kumbakonam','pathanamthitta','changanassery','payyanur','cherthala','dadar-mumbai','mulund-mumbai','dwarka-delhi','tilak-nagar-delhi','rohini-delhi','laxminagar-delhi','kalyan-nagar-bangalore','basavanagudi-bangalore','jayanagar-bangalore','ameerpet-hyderabad','kukatpally-hyderabad','dilsukhnagar-hyderabad','secunderabad','mehdipatnam-hyderabad','madhapur-hyderabad','banjara-hills-hyderabad','begumpet-hyderabad','himayat-nagar-hyderabad','nellore','nizamabad','ranchi','junagadh','morbi','mehsana','surendranagar','ajmer','alwar','kota','kathmandu'];

        // Default settings for all city pages
        $citySettings = [
            'priority' => '0.80',
            'changefreq' => 'weekly'
        ];

        // ---- UK EDUCATION CITY PAGES ----
        $ukCities = ['kochi', 'chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai', 'thrissur', 'pune', 'coimbatore', 'udaipur', 'ahmedabad', 'kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $ukCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ---- Australia EDUCATION CITY PAGES ----
        $australiaCities = ['chennai', 'delhi', 'hyderabad', 'bangalore', 'ahmedabad', 'udaipur', 'pune', 'mumbai', 'kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $australiaCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ---- France EDUCATION CITY PAGES ----
        $franceCities = ['chennai', 'delhi', 'hyderabad', 'udaipur', 'bangalore', 'mumbai', 'kolkata','pune', 'ahmedabad',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $franceCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ---- New Zealand EDUCATION CITY PAGES ----
        $newZealandCities = ['chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'trivandrum', 'udaipur', 'mumbai', 'kolkata', 'pune', 'ahmedabad',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $newZealandCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ---- IRELAND EDUCATION CITY PAGES ----
        $irelandCities = ['kochi', 'chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai', 'thrissur', 'udaipur', 'pune',  'ahmedabad', 'kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $irelandCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ---- CANADA EDUCATION CITY PAGES ----
        $canadaCities = ['kochi', 'chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai', 'trivandrum', 'pune', 'coimbatore', 'ahmedabad', 'kolkata', 'noida', 'chandigarh', 'gurgaon', 'vijayawada', 'udaipur',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","davanagere","dehradun","durgapur","gandhinagar","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udupi","ujjain","vadodara","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $canadaCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ---- GERMANY EDUCATION CITY PAGES ----
        $germanyCities = ['chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai', 'chandigarh', 'pune', 'ahmedabad', 'udaipur', 'kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $germanyCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ---- USA EDUCATION CITY PAGES ----
        $usaCities = ['chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai', 'pune', 'udaipur', 'ahmedabad', 'kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $usaCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ---- DUBAI EDUCATION CITY PAGES ----
        $dubaiCities = ['kochi','chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai','thrissur', 'pune','coimbatore', 'udaipur', 'ahmedabad','kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];


        $dubaiCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
       ];

       // ---- SWITZERLAND EDUCATION CITY PAGES ----
        $switzerlandCities = ['kochi','chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai', 'pune', 'ahmedabad','kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udaipur","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $switzerlandCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ---- ITALY EDUCATION CITY PAGES ----
        $italyCities = ['kochi', 'chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai', 'pune', 'ahmedabad', 'kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udaipur","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $italyCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];
        
        // ---- SINGAPORE EDUCATION CITY PAGES ----
        $singaporeCities = ['kochi', 'chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai', 'pune', 'ahmedabad', 'kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udaipur","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $singaporeCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];
        
        // ---- NETHERLANDS EDUCATION CITY PAGES ----
        $netherlandsCities = ['kochi', 'chennai', 'delhi', 'kerala', 'hyderabad', 'bangalore', 'mumbai', 'pune', 'ahmedabad', 'kolkata',"ajmer","amritsar","anand","belagavi","berhampur","bhavnagar","bhopal","bilaspur","chandigarh","coimbatore","davanagere","dehradun","durgapur","gandhinagar","gurgaon","gwalior","indore","jaipur","jammu","jamnagar","jamshedpur","jodhpur","kanpur","karimnagar","kolhapur","kota","lucknow","ludhiana","madurai","mangalore","muzaffarpur","nagpur","noida","patiala","patna","rajahmundry","ratlam","rourkela","salem","sambalpur","silchar","siliguri","solapur","surat","tiruppur","trichy","udaipur","udupi","ujjain","vadodara","vijayawada","visakhapatnam","warangal","thrissur","mysuru","nashik","aurangabad","kozhikode","thiruvananthapuram"];

        $netherlandsCitySettings = [
            'priority' => '0.75',
            'changefreq' => 'weekly'
        ];

        // ----- IELTS COACHING CITY PAGES -------


        // ---- START XML ----
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // ---- STATIC PAGES GENERATION ----
        foreach ($staticPages as $page) {
            $xml .= '
                <url>
                    <loc>' . url($page['url']) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $page['priority'] . '</priority>
                    <changefreq>' . $page['changefreq'] . '</changefreq>
                </url>';
        }

        // ---- CITY PAGES GENERATION ----
        foreach ($cities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/study-abroad-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $citySettings['priority'] . '</priority>
                    <changefreq>' . $citySettings['changefreq'] . '</changefreq>
                </url>';
        }

        // ---- UK EDUCATION CITY PAGES GENERATION ----
        foreach ($ukCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/uk-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $ukCitySettings['priority'] . '</priority>
                    <changefreq>' . $ukCitySettings['changefreq'] . '</changefreq>
                </url>';
        }

        // ---- Australia EDUCATION CITY PAGES GENERATION ----
        foreach ($australiaCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/australia-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $australiaCitySettings['priority'] . '</priority>
                    <changefreq>' . $australiaCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- France EDUCATION CITY PAGES GENERATION ----
        foreach ($franceCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/france-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $franceCitySettings['priority'] . '</priority>
                    <changefreq>' . $franceCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- newZealand EDUCATION CITY PAGES GENERATION ----
        foreach ($newZealandCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/new-zealand-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $newZealandCitySettings['priority'] . '</priority>
                    <changefreq>' . $newZealandCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- IRELAND EDUCATION CITY PAGES GENERATION ----
        foreach ($irelandCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/ireland-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $irelandCitySettings['priority'] . '</priority>
                    <changefreq>' . $irelandCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- CANADA EDUCATION CITY PAGES GENERATION ----
        foreach ($canadaCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/canada-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $canadaCitySettings['priority'] . '</priority>
                    <changefreq>' . $canadaCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- GERMANY EDUCATION CITY PAGES GENERATION ----
        foreach ($germanyCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/germany-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $germanyCitySettings['priority'] . '</priority>
                    <changefreq>' . $germanyCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- USA EDUCATION CITY PAGES GENERATION ----
        foreach ($usaCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/usa-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $usaCitySettings['priority'] . '</priority>
                    <changefreq>' . $usaCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        // ---- DUBAI EDUCATION CITY PAGES GENERATION ----
        foreach ($dubaiCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/dubai-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $dubaiCitySettings['priority'] . '</priority>
                    <changefreq>' . $dubaiCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- SWITZERLAND EDUCATION CITY PAGES GENERATION ----
        foreach ($switzerlandCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/switzerland-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $switzerlandCitySettings['priority'] . '</priority>
                    <changefreq>' . $switzerlandCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- ITALY EDUCATION CITY PAGES GENERATION ----
        foreach ($italyCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/italy-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $italyCitySettings['priority'] . '</priority>
                    <changefreq>' . $italyCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- SINGAPORE EDUCATION CITY PAGES GENERATION ----
        foreach ($singaporeCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/singapore-education-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $singaporeCitySettings['priority'] . '</priority>
                    <changefreq>' . $singaporeCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        
        // ---- NETHERLANDS EDUCATION CITY PAGES GENERATION ----
        foreach ($netherlandsCities as $city) {
            $xml .= '
                <url>
                    <loc>' . url('/netherlands-study-abroad-consultants-in-' . $city) . '</loc>
                    <lastmod>' . now()->toDateString() . '</lastmod>
                    <priority>' . $netherlandsCitySettings['priority'] . '</priority>
                    <changefreq>' . $netherlandsCitySettings['changefreq'] . '</changefreq>
                </url>';
        }
        // ---- IELTS CITY PAGES ----
        $ieltsCities = [
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

        foreach ($ieltsCities as $city) {

            $city = strtolower(str_replace(' ', '-', $city));

            $xml .= '
    <url>
        <loc>' . url('/ielts-coaching-in-' . $city) . '</loc>
        <lastmod>' . now()->toDateString() . '</lastmod>
        <priority>0.85</priority>
        <changefreq>weekly</changefreq>
    </url>';
        }

        // ----- TOEFL CITY IMAGES ---- 

        $toeflCities = [
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

        foreach ($toeflCities as $city) {

            $city = strtolower(str_replace(' ', '-', $city));

            $xml .= '
    <url>
        <loc>' . url('/toefl-coaching-in-' . $city) . '</loc>
        <lastmod>' . now()->toDateString() . '</lastmod>
        <priority>0.85</priority>
        <changefreq>weekly</changefreq>
    </url>';
        }

        // ------ PTE CITY Pages ------

         $pteCities = [
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

        foreach ($pteCities as $city) {

            $city = strtolower(str_replace(' ', '-', $city));

            $xml .= '
    <url>
        <loc>' . url('/pte-coaching-in-' . $city) . '</loc>
        <lastmod>' . now()->toDateString() . '</lastmod>
        <priority>0.85</priority>
        <changefreq>weekly</changefreq>
    </url>';
        }

        // ------- GMAT EXAM----------
        
         $gmatCities = [
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

        foreach ($gmatCities as $city) {

            $city = strtolower(str_replace(' ', '-', $city));

            $xml .= '
    <url>
        <loc>' . url('/gmat-coaching-in-' . $city) . '</loc>
        <lastmod>' . now()->toDateString() . '</lastmod>
        <priority>0.85</priority>
        <changefreq>weekly</changefreq>
    </url>';
        }


        // --------- GRE EXAM---------

         $greCities = [
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

        foreach ($greCities as $city) {

            $city = strtolower(str_replace(' ', '-', $city));

            $xml .= '
    <url>
        <loc>' . url('/gre-coaching-in-' . $city) . '</loc>
        <lastmod>' . now()->toDateString() . '</lastmod>
        <priority>0.85</priority>
        <changefreq>weekly</changefreq>
    </url>';
        }

        // --------- SAT EXAM -----------

          $satCities = [
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

        foreach ($satCities as $city) {

            $city = strtolower(str_replace(' ', '-', $city));

            $xml .= '
    <url>
        <loc>' . url('/sat-coaching-in-' . $city) . '</loc>
        <lastmod>' . now()->toDateString() . '</lastmod>
        <priority>0.85</priority>
        <changefreq>weekly</changefreq>
    </url>';
        }

        // -------- Duolingo Exam --------

           $duolingoCities = [
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

        foreach ($duolingoCities as $city) {

            $city = strtolower(str_replace(' ', '-', $city));

            $xml .= '
    <url>
        <loc>' . url('/duolingo-coaching-in-' . $city) . '</loc>
        <lastmod>' . now()->toDateString() . '</lastmod>
        <priority>0.85</priority>
        <changefreq>weekly</changefreq>
    </url>';
        }

        $xml .= '</urlset>';

        // ---- RETURN SITEMAP ----
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
