@php
    $faqs = [
        ['question' => '1. Why is course selection important for studying abroad?', 'answer' => 'Choosing the right course is essential because it directly impacts your academic success, career opportunities, and future job prospects. A well-selected programme aligns with your interests, skills, and long-term career goals while improving your chances of admission and visa approval.'],
         ['question' => '2.	How does WTS help with course selection for study abroad?', 'answer' => 'WTS provides personalised guidance by analysing your academic background, career goals, and preferences. Our experts shortlist suitable courses, recommend the best universities, and help you make confident decisions based on global career demand.'],
        ['question' => '3.	 Can I get help if I am unsure which course to choose?', 'answer' => 'Yes. Many students are unsure about their study path, and our counsellors specialise in helping you explore options, understand industry trends, and select the right programme based on your strengths and interests.'],
        ['question' => '4.	Do you provide course selection guidance for undergraduate and postgraduate programmes?', 'answer' => 'Yes, WTS supports students planning undergraduate (UG), postgraduate (PG), diploma, and specialised professional courses across various countries.'],
        ['question' => '5. How do you match students with the right course and university?', 'answer' => 'We evaluate your academic qualifications, English language proficiency, career objectives, and budget. Based on this analysis, we recommend suitable courses and universities that match your profile.'],
    ];
@endphp

<x-faq :faqs="$faqs" />