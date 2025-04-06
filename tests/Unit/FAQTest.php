<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\FAQ;
use App\Models\Group;
use Tests\TestCase;

class FAQTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_valid_faq()
    {
        $faq = FAQ::factory()->create(); // Use the factory to create an FAQ
        // Now the FAQ has all required fields, including a valid group_id
        $this->assertNotNull($faq->group_id);
        $this->assertIsInt($faq->group_id);
        $this->assertNotNull($faq->question);
        $this->assertNotNull($faq->answer);
    }
    /** @test */

    public function it_requires_a_question()
    {
        $faq = FAQ::factory()->make(['question' => null]); // Use make to create a model without saving
        $this->assertNull($faq->question);
    }
    /** @test */
    public function it_requires_an_answer()
    {
        $faq = FAQ::factory()->make(['answer' => null]);
        $this->assertNull($faq->answer);
    }
    /** @test */
    public function it_limits_question_length()
    {
        $longQuestion = str_repeat('A', 256);
        $faq = FAQ::factory()->make(['question' => $longQuestion]);
        $this->assertEquals($longQuestion, $faq->question);
    }
    /** @test */
    public function it_belongs_to_a_group()
    {
        $faq = FAQ::factory()->create();
        $this->assertInstanceOf(Group::class, $faq->group);
    }
    /** @test */
    public function it_requires_a_group_id()
    {
        $faq = new FAQ([
            'question' => 'Question without group.',
            'answer' => 'Answer without group.',
        ]);
        $this->assertNull($faq->group_id);
        $this->assertEquals('Question without group.', $faq->question);
        $this->assertEquals('Answer without group.', $faq->answer);
    }
}