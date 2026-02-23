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
                'id' => 'livingstone-njeru',
                'title' => 'Livingstone Njeru: From Sponsored Child to Director',
                'category' => 'Featured Story',
                'category_color' => 'blue',
                'description' => 'Livingstone started as a sponsored child and rose through Educate the Orphans\' programmes to become our Kenya Director. His journey showcases how education and community support create leaders who give back.',
                'quote' => 'Education opened doors I never thought possible.',
                'image' => 'livingstone-njeru.jpg'
            ],
            [
                'id' => 'makena-gilugu',
                'title' => 'Makena N Gilugu: Now an Accountant',
                'category' => 'Professional Achievement',
                'category_color' => 'green',
                'description' => 'With sponsorship from A+P McKenna, Makena received the education and support needed to pursue her dreams. Today she works as an accountant with a Kenyan bank, serving her community.',
                'quote' => 'My sponsor believed in my potential when I couldn\'t see it myself.',
                'image' => 'makena-gilugu.jpg'
            ],
            [
                'id' => 'muthuuri-kabea',
                'title' => 'Muthuuri Kabea: From Loss to Healing Professions',
                'category' => 'Overcoming Adversity',
                'category_color' => 'purple',
                'description' => 'Despite losing his father at a young age, Muthuuri persevered through Educate the Orphans\' support. Thanks to T. Kelly\'s sponsorship, he became a radiographer at Chogoria Hospital, helping others heal.',
                'quote' => 'Pain became my purpose to serve others.',
                'image' => 'muthuuri-kabea.jpg'
            ],
            [
                'id' => 'mukembi-karegi',
                'title' => 'Mukembi Karegi: Rising in Banking',
                'category' => 'Financial Security',
                'category_color' => 'orange',
                'description' => 'With W. Taylor\'s sponsorship, Mukembi gained the education necessary to pursue a career in finance. He now works as a banker with one of Kenya\'s national banks in Nairobi.',
                'quote' => 'I\'m building a secure future for my family.',
                'image' => 'mukembi-karegi.jpg'
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
