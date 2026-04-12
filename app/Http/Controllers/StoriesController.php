<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class StoriesController extends Controller
{
    /**
     * Display the stories page
     */
    public function index(): View
    {
        $stories = [
            [
                'id' => 'purity-kathomi',
                'title' => "Purity Kathomi's Story",
                'category' => 'Featured Story',
                'category_color' => 'teal',
                'description' => 'Watch Purity share her own story — how Educate the Orphans gave her access to education and transformed her life in Tharaka, Kenya.',
                'quote' => 'Education changed everything for me.',
                'youtube_id' => 'i58iM1sJktI'
            ],
            [
                'id' => 'mutrii-mwari',
                'title' => "Mutrii Mwari: Life Changed",
                'category' => 'Featured Story',
                'category_color' => 'teal',
                'description' => 'Hear Mutrii Mwari explain how as a poor child he couldn\'t get an education, and how through ETO\'s support he got educated and is now an accountant.',
                'quote' => 'Education lifted me out of poverty and gave me a future I never imagined.',
                'youtube_id' => 'qEYqQMc8aDo'
            ],
            [
                'id' => 'alex-eto-alumni',
                'title' => "Alex: How ETO Changed My Life",
                'category' => 'Alumni Story',
                'category_color' => 'teal',
                'description' => 'Alex shares his story with our ETO Team, telling them how he became born again, and how he now works as a Highway Safety Inspector.',
                'quote' => 'ETO didn\'t just give me an education — it gave me a whole new life.',
                'youtube_id' => 'n6BwzBM41rY'
            ],
            [
                'id' => 'livingstone-njeru',
                'title' => 'Livingstone Njeru: From Sponsored Child to Director',
                'category' => 'Featured Story',
                'category_color' => 'blue',
                'card_description' => 'Livingstone started as a sponsored child and rose through Educate the Orphans\' programmes to become our Kenya Director.',
                'description' => 'Livingstone started as a sponsored child and rose through Educate the Orphans\' programmes to become our Kenya Director. His journey showcases how education and community support create leaders who give back.',
                'quote' => 'Education opened doors I never thought possible.',
                'image' => 'livingstone-njeru-job.jpg',
                'image_child' => 'livingstone-njeru-child.jpg',
                'image_caption' => 'Livingstone today — Kenya Director',
                'image_child_caption' => 'Livingstone working with ETO children',
            ],
            [
                'id' => 'makena-gilugu',
                'title' => 'Makena N Gilugu: Now an Accountant',
                'category' => 'Professional Achievement',
                'category_color' => 'green',
                'card_description' => 'Sponsored through ETO, Makena went on to become an Accountant with a Kenyan bank — a wonderful example of education changing a life.',
                'description' => 'The photo above shows Makena when she first came to ETO as a young girl. Through the support of ETO, she was sponsored and received an education that would go on to transform her life.' . "\n\n" . 'Makena now works as an Accountant with a Kenyan bank — a wonderful testament to what education can achieve. A heartfelt thank you to her sponsors, A+P McKenna from Ireland, whose generosity truly changed her life.',
                'quote' => 'My sponsor changed my life forever.',
                'image' => 'makena-gilugu-job.jpg',
                'image_child' => 'makena-gilugu-child.jpg',
                'image_caption' => 'Makena today',
                'image_child_caption' => 'Makena when she first came to ETO',
            ],
            [
                'id' => 'muthuuri-kabea',
                'title' => 'Muthuuri Kabea: From Loss to Healing Professions',
                'category' => 'Overcoming Adversity',
                'category_color' => 'purple',
                'description' => 'Muthuuri has 6 brothers and 1 sister. His father died after falling from a tree collecting honey. Despite losing his father at a young age, Muthuuri persevered through Educate the Orphans\' support. He was sponsored by T. Kelly and received his education at Karani school.' . "\n\n" . 'Muthuuri currently works as a radiographer at Chogoria Hospital.',
                'quote' => 'I\'m now able to help others through my medical profession.',
                'image' => 'muthuuri-kabea-job.jpg',
                'image_child' => 'muthuuri-kabea-child.jpg',
                'image_caption' => 'Muthuuri today — working as a radiographer',
                'image_child_caption' => 'Muthuuri aged 7',
            ],
            [
                'id' => 'mukembi-karegi',
                'title' => 'Mukembi Karegi: Rising in Banking',
                'category' => 'Financial Security',
                'category_color' => 'orange',
                'card_description' => 'With W. Taylor\'s sponsorship, Mukembi gained the education necessary to pursue a career in finance. He now works as a banker with one of Kenya\'s national banks in Nairobi.',
                'description' => 'With W. Taylor\'s sponsorship, Mukembi gained the education necessary to pursue a career in finance. He now works as a banker with one of Kenya\'s national banks in Nairobi.',
                'quote' => 'Thank you to W. Taylor for sponsoring me and helping to change my life.',
                'image' => 'mukembi-karegi-job.jpg',
                'image_child' => 'mukembi-karegi-child.jpg',
                'image_caption' => 'Mukembi today — working in banking',
                'image_child_caption' => 'Mukembi as a child',
            ],
            [
                'id' => 'spiritual-leaders',
                'title' => 'Sponsored Children Becoming Spiritual Leaders',
                'category' => 'Community Leaders',
                'category_color' => 'indigo',
                'description' => 'Many former Educate the Orphans students have answered the call to ministry. They now serve as pastors, church leaders, and spiritual counselors, bringing hope and faith to their communities.',
                'quote' => 'Education gave me the tools to serve my faith and community.',
                'image' => 'spiritual-leaders.jpg'
            ],
            [
                'id' => 'sponsor-reunion',
                'title' => 'Living Proof: A Sponsor Meets Her Impact',
                'category' => 'Sponsor Impact',
                'category_color' => 'red',
                'description' => 'When sponsors visit Kenya, they witness firsthand the transformation their investment makes. Former sponsored children, now professionals, warmly greet their sponsors—a profound moment showing education\'s lasting legacy.',
                'quote' => 'This is truly a miracle, all thanks to our sponsors.',
                'image' => 'sponsor-reunion.jpg'
            ]
        ];

        return view('stories', [
            'stories' => $stories,
            'title' => 'Stories of Change',
        ]);
    }
}
