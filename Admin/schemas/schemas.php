<?php

return [

    "trusted_brand" => [
        "table" => "trusted_brand",
        "primary_key" => "id",
        "fields" => [
            "brand_images" => "file"
        ]
    ],

    "industries_serve" => [
        "table" => "industries_serve",
        "primary_key" => "id",
        "fields" => [
            "serve_image" => "file",
            "serve_title" => "text",
            "serve_description" => "textarea"
        ]
    ],

    "hero_section" => [
        "table" => "hero_section",
        "primary_key" => "id",
        "fields" => [
            "hero_video" => "file",
            "hero_title" => "text",
            "hero_description" => "textarea"
        ]
    ],

"mobile_develop" => [
    "table" => "mobile_develop",
    "primary_key" => "id",
    "fields" => [
        "service_id" => [          // NEW: link to services table
            "type" => "hidden"     // comes from manage page URL
        ],
        "mobile_dev_images" => "file",
        "mobile_dev_title" => "text",
        "mobile_dev_description" => "textarea",
        "mobile_heading" => "text",        // NEW FIELD
        "mobile_subheading" => "text"      // NEW FIELD
    ]
],
"app_experties" => [
    "table" => "app_experties",
    "primary_key" => "id",
    "fields" => [
        "service_id" => [
            "type" => "hidden"
        ],
        "application_images" => "file"
    ]
],

"our_feature" => [
    "table" => "our_feature",
    "primary_key" => "id",
    "fields" => [
        "service_id" => [
            "type" => "hidden"
        ],
        "feature_images" => "file",
        "feature_title" => "text",
        "feature_description" => "textarea",
        "feature_heading" => "text",        // NEW FIELD
        "feature_subheading" => "text",     // NEW FIELD
        "feature_button_text" => "text"     // NEW FIELD
    ]
],

"our_stack" => [
    "table" => "our_stack",
    "primary_key" => "id",
    "fields" => [
        "service_id" => [
            "type" => "hidden"
        ],
        "stack_image" => "file",
        "stack_heading" => "text",        // NEW FIELD
        "stack_subheading" => "text",     // NEW FIELD
        "stack_button_text" => "text"     // NEW FIELD
    ]
],

    "admin" => [
        "table" => "admin",
        "primary_key" => "id",
        "fields" => [
            "name" => "text",
            "email" => "text",
            "password" => "text",
            // "created_at" => "datetime"
        ]
    ],
"contact_messages" => [
    "table" => "contact_messages",
    "primary_key" => "id",
    "fields" => [
        "name" => "text",
        "email" => "email",
        "phone" => "text",
        "services" => "textarea",
        "project_details" => "textarea",
        "looking_job" => "text",
        "status" => "text" // 👈 Added
    ]
],
"blogs_content" => [
    'table' => 'blogs_content',
    'primary_key' => 'id',

    'fields' => [

        'blogs_title' => [
            'type' => 'text',
            'label' => 'Blog Title',
            'required' => true,
            'maxlength' => 255
        ],

        'slug' => [
    'type'   => 'slug',
    'label'  => 'SEO Slug',
    'source' => 'blogs_title',
    'unique' => true
],

        'blogs_description' => [
            'type' => 'textarea',
            'label' => 'Short Description (SEO)',
            'required' => true
        ],

        'blogs_content' => [
            'type' => 'editor',   // CKEditor
            'label' => 'Blog Content',
            'required' => true
        ],

    'blogs_image' => [
    'type' => 'file',
    'label' => 'Featured Image'
],
'blogs_left_image' => [
    'type' => 'file',
    'label' => 'Left Content Image'
],
'blogs_right_image' => [
    'type' => 'file',
    'label' => 'Right Content Image'
],



     
    ]
],

'case_studies' => [
    'table' => 'case_studies',
    'primary_key' => 'id',

    'fields' => [

        'case_study_title' => [
            'type' => 'text',
            'label' => 'Case Study Title',
            'required' => true,
            'maxlength' => 255
        ],
  'slug' => [
    'type'   => 'slug',
    'label'  => 'SEO Slug',
    'source' => 'case_study_title',
    'unique' => true
],

        'case_study_description' => [
            'type' => 'textarea',
            'label' => 'Case Study Description',
            'required' => true
        ],

        'case_study_image' => [
            'type' => 'file',
            'label' => 'Case Study Image'
        ],

    ]
],
'services' => [
    'table' => 'services',
    'primary_key' => 'id',

    'fields' => [
        'service_title' => [
            'label' => 'Service Title',
            'type' => 'text',
            'required' => true,
        ],

        'slug' => [
            'label' => 'Service Slug (SEO)',
            'type' => 'slug',
            'source' => 'service_title',
            'required' => true,
            'unique' => true,
        ],

        'service_image' => [
            'label' => 'Main Service Image',
            'type' => 'file',
            'upload_dir' => 'uploads/services/',
        ],

        'service_title2' => [
            'label' => 'Secondary Title',
            'type' => 'text',
        ],

        'service_description' => [
            'label' => 'Service Description',
            'type' => 'textarea',
        ],

        'service_description_2' => [
            'label' => 'Service Description (Second)',
            'type' => 'textarea',
        ],

        'service_right_image' => [
            'label' => 'Right Side Image',
            'type' => 'file',
            'upload_dir' => 'uploads/services/',
        ],

        // ✅ New Button Text Field
        'service_button_text' => [
            'label' => 'Service Button Text',
            'type' => 'text',
        ],
    ],
],
'teams' => [
    'table' => 'teams',
    'fields' => [
        'team_title' => [
            'label' => 'Team Title',
            'type' => 'text',
            'required' => true,
        ],
        'team_description' => [
            'label' => 'Team Description',
            'type' => 'textarea',
            'required' => true,
        ],
        'leader_name' => [
            'label' => 'Leader Name',
            'type' => 'text',
            'required' => true,
        ],
        'leader_image' => [
            'label' => 'Leader Image',
            'type' => 'file',
            'required' => false,
            'upload_path' => 'uploads/teams/',
        ],
        'leader_description' => [
            'label' => 'Leader Description',
            'type' => 'textarea',
            'required' => true,
        ],
    ],
],
'portfolio' => [
    'table' => 'portfolio',
    'fields' => [

      'portfolio_title' => [
            'label' => 'Portfolio Title',
            'type' => 'text',
            'required' => true,
        ],
        // ... other fields ...

        'slug' => [
            'label' => 'Portfolio Slug (SEO)',
            'type' => 'slug',           // indicates auto-generation
            'source' => 'portfolio_title', // field to base slug on
            'required' => true,
            'unique' => true,           // ensures DB uniqueness
        ],

        'portfolio_subtitle' => [
            'label' => 'Portfolio Subtitle',
            'type' => 'text',
            'required' => true,
        ],

        'portfolio_description' => [
            'label' => 'Portfolio Description',
            'type' => 'textarea',
            'required' => true,
        ],

        'portfolio_image' => [
            'label' => 'Portfolio Image',
            'type' => 'file',
            'required' => false,
            'upload_path' => 'uploads/portfolio/',
        ],

        'address_description' => [
            'label' => 'Address Description',
            'type' => 'textarea',
            'required' => true,
        ],

        'portfolio_alpha_title' => [
            'label' => 'Portfolio Alpha Title',
            'type' => 'text',
            'required' => true,
        ],

        'portfolio_alpha_description' => [
            'label' => 'Portfolio Alpha Description',
            'type' => 'textarea',
            'required' => true,
        ],

        'portfolio_alpha_image' => [
            'label' => 'Portfolio Alpha Image',
            'type' => 'file',
            'required' => false,
            'upload_path' => 'uploads/portfolio/',
        ],

        'portfolio_beta_title' => [
            'label' => 'Portfolio Beta Title',
            'type' => 'text',
            'required' => true,
        ],

        'portfolio_beta_description' => [
            'label' => 'Portfolio Beta Description',
            'type' => 'textarea',
            'required' => true,
        ],

        'portfolio_beta_image' => [
            'label' => 'Portfolio Beta Image',
            'type' => 'file',
            'required' => false,
            'upload_path' => 'uploads/portfolio/',
        ],

        'conclusion_title' => [
            'label' => 'Conclusion Title',
            'type' => 'text',
            'required' => true,
        ],

        'conclusion_description' => [
            'label' => 'Conclusion Description',
            'type' => 'textarea',
            'required' => true,
        ],

        'key_title' => [
            'label' => 'Key Title',
            'type' => 'text',
            'required' => true,
        ],

        'key_description' => [
            'label' => 'Key Description',
            'type' => 'textarea',
            'required' => true,
        ],

        'key_image' => [
            'label' => 'Key Image',
            'type' => 'file',
            'required' => false,
            'upload_path' => 'uploads/portfolio/',
        ],

        'step_title' => [
            'label' => 'Step Title',
            'type' => 'text',
            'required' => true,
        ],

        'step_description' => [
            'label' => 'Step Description',
            'type' => 'textarea',
            'required' => true,
        ],

        'step_image' => [
            'label' => 'Step Image',
            'type' => 'file',
            'required' => false,
            'upload_path' => 'uploads/portfolio/',
        ],

        'key_service_title' => [
            'label' => 'Key Service Title',
            'type' => 'text',
            'required' => true,
        ],

        'key_service_description' => [
            'label' => 'Key Service Description',
            'type' => 'textarea',
            'required' => true,
        ],

        'benefits_title' => [
            'label' => 'Benefits Title',
            'type' => 'text',
            'required' => true,
        ],

        'benefit_description' => [
            'label' => 'Benefit Description',
            'type' => 'textarea',
            'required' => true,
        ],

    ],
],

];
?>
