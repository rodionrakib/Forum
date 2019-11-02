<?php

namespace Tests\Unit;

use App\Reply;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_owner()
    {
        $this->withoutExceptionHandling();

        $reply = factory(Reply::class)->create();

        $this->assertInstanceOf(User::class,$reply->owner);
    }

    /** @test */
    public function it_can_be_added_to_thread_owner()
    {
        $this->withoutExceptionHandling();

        $reply = factory(Reply::class)->create();

        $this->assertInstanceOf(User::class,$reply->owner);
    }
}
