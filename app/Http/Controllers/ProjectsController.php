<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProjectsController extends Controller
{
    /**
     * Display the projects page
     */
    public function index(): View
    {
        $projects = [
            [
                'id' => 'famine-relief',
                'title' => 'Famine Relief',
                'description' => 'Emergency food support during drought and crisis.',
                'long_description' => 'During times of drought and food scarcity, we provide emergency food assistance to vulnerable families and children in the Tharaka region. Our famine relief programmes ensure that no child goes hungry during critical periods.',
                'impact' => 'Supports hundreds of children and families during crisis periods',
                'image' => 'famine-relief.jpg'
            ],
            [
                'id' => 'clean-water',
                'title' => 'Clean Water Project',
                'description' => 'Reliable water access for families and communities.',
                'long_description' => 'Access to clean water is fundamental to health. Our clean water initiative focuses on bringing reliable water sources to communities that have historically struggled with water scarcity. We install and maintain water systems that benefit entire communities.',
                'impact' => 'Provides clean water to 60,000+ people across the region',
                'image' => 'clean-water.jpg'
            ],
            [
                'id' => 'eto-shamba',
                'title' => 'ETO Farms (Shamba)',
                'description' => 'Sustainable agriculture and skills training.',
                'long_description' => 'Our farm project teaches practical agricultural skills while producing food for the communities we serve. The ETO Farms (Shamba) serves as both a training centre and a sustainable food production initiative, teaching modern and traditional farming techniques.',
                'impact' => 'Trains youth in sustainable agriculture and provides ongoing food support',
                'image' => 'eto-shamba.jpg'
            ],
            [
                'id' => 'rea-rescue',
                'title' => 'ETO Rescue Centres',
                'description' => 'A safe haven for children rescued from trafficking, child marriage, and abuse.',
                'long_description' => '<p>Our ETO Rescue Centres exist to provide safety and hope for children rescued from some of the most devastating situations — including human trafficking, child marriage, and abuse.</p><p>Each centre offers a secure, caring environment where children are given a safe roof over their heads and access to education — the foundations they need to begin rebuilding their lives.</p><p>Rooted in our Christian faith, we believe every child is precious and deserving of love, protection, and the chance of a brighter future.</p>',
                'impact' => 'Provides comprehensive care and rehabilitation for at-risk children',
                'image' => 'rea-rescue.jpg'
            ],
            [
                'id' => 'education',
                'title' => 'Education Programmes',
                'description' => 'Operating schools across multiple locations educating 1,500 children every year.',
                'long_description' => 'Education is at the heart of everything we do. We operate seven schools across the Tharaka region, educating 1,500 children every year. Our education programmes provide not just academic instruction, but also nutritional support, school supplies, and pastoral care.',
                'impact' => 'Educates and feeds 1,500 children every year across 7 schools',
                'image' => 'education.jpg'
            ],
            [
                'id' => 'sponsorship',
                'title' => 'Supporting Children & Families',
                'description' => 'Helping every child in need — no child is ever turned away.',
                'long_description' => '<p>We believe that no child should be left without support simply because an individual donor has not been found for them. That is why we moved away from individual sponsorship — so that every child in our care receives what they need, regardless of circumstance.</p><p>Donations given for a specific project are used exactly for that purpose. General donations are shared across all the children we serve, ensuring no one is ever overlooked.</p><p>We trust that God will provide exactly what is required — and He never lets us down. Your generosity, however large or small, is part of that provision and makes a real difference to the children we serve.</p>',
                'impact' => 'Every donation reaches every child — no child is turned away for lack of a sponsor',
                'image' => 'sponsorship.jpg'
            ]
        ];

        return view('projects', [
            'projects' => $projects,
            'title' => 'Projects and Programmes',
        ]);
    }
}
