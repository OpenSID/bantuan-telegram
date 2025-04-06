<?php
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\FAQ;
use App\Models\Group;

class FAQSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            'General' => Group::where('name', 'General')->first()->id, 
            'Account' => Group::where('name', 'Account')->first()->id, 
            'Technical' => Group::where('name', 'Technical')->first()->id, 
        ];

        $faqs = [ 
            [ 
                'group_id' => $groups['General'], 
                'question' => 'What is your company about? ', 
                'answer' => 'We are a leading provider of innovative solutions. ', 
            ],
            [ 
                'group_id' => $groups['General'], 
                'question' => 'Where are you located? ', 
                'answer' => 'Our main office is located in New York, but we have offices worldwide. ', 
            ],
            [ 
                'group_id' => $groups['Account'], 
                'question' => 'How do I create an account? ', 
                'answer' => 'You can create an account by clicking the "Sign Up" button on our website. ', 
            ],
            [ 
                'group_id' => $groups['Account'], 
                'question' => 'I forgot my password. How can I reset it? ', 
                'answer' => 'Click on the "Forgot Password" link on the login page and follow the instructions. ', 
            ],
            [ 
                'group_id' => $groups['Technical'], 
                'question' => 'What are the system requirements? ', 
                'answer' => 'Our software requires a minimum of 8GB RAM and a 2.0 GHz processor. ', 
            ],
            [ 
                'group_id' => $groups['Technical'], 
                'question' => 'I am having trouble installing the software. What should I do? ', 
                'answer' => 'Please refer to our installation guide or contact our support team for assistance. ', 
            ],
        ]; 

        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }
    }
}