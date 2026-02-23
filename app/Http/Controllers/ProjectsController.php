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
                'long_description' => 'Access to clean water is fundamental to health and dignity. Our clean water initiative focuses on bringing reliable water sources to communities that have historically struggled with water scarcity. We install and maintain water systems that benefit entire villages.',
                'impact' => 'Provides clean water to 40,000+ people across the region',
                'image' => 'clean-water.jpg'
            ],
            [
                'id' => 'eto-shamba',
                'title' => 'ETO Shamba (Farm)',
                'description' => 'Sustainable agriculture and skills training.',
                'long_description' => 'Our farm project teaches practical agricultural skills while producing food for the communities we serve. The ETO Shamba serves as both a training centre and a sustainable food production initiative, teaching modern and traditional farming techniques.',
                'impact' => 'Trains youth in sustainable agriculture and provides ongoing food support',
                'image' => 'eto-shamba.jpg'
            ],
            [
                'id' => 'rea-rescue',
                'title' => 'Rea Rescue Centre',
                'description' => 'Care and rehabilitation for vulnerable children.',
                'long_description' => 'The Rea Rescue Centre provides specialized care and rehabilitation for the most vulnerable children in our region. We offer safe shelter, medical care, counseling, and educational support for children who have experienced trauma or exploitation.',
                'impact' => 'Provides comprehensive care and rehabilitation for at-risk children',
                'image' => 'rea-rescue.jpg'
            ],
            [
                'id' => 'education',
                'title' => 'Education Programmes',
                'description' => 'Operating schools across multiple locations serving over 3,000 children.',
                'long_description' => 'Education is at the heart of everything we do. We operate seven schools across the Tharaka region, serving over 3,000 children annually. Our education programmes provide not just academic instruction, but also nutritional support, school supplies, and pastoral care.',
                'impact' => 'Educates and feeds 3,000+ children annually across 7 schools',
                'image' => 'education.jpg'
            ],
            [
                'id' => 'sponsorship',
                'title' => 'Child Sponsorship Programme',
                'description' => 'Support a child\'s education, nutrition, and care within their family.',
                'long_description' => 'Rather than operating orphanages, we believe in keeping children with their families while providing the financial support they need. Through our sponsorship programme, supporters worldwide can directly impact a child\'s life while maintaining family bonds and cultural connections.',
                'impact' => 'Supports children to remain with extended family while receiving care and education',
                'image' => 'sponsorship.jpg'
            ]
        ];

        return view('projects', [
            'projects' => $projects,
            'title' => 'Projects and Programmes',
        ]);
    }
}
