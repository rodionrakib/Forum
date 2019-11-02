<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function unauthenticated_user_may_not_add_replies()
    {
        //$this->withoutExceptionHandling();


        $response = $this->post('threads/php/1/replies',[]);

        $response->assertRedirect('/login');


    }
    /** @test */
    public function a_authenticated_user_can_add_reply_in_thread()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = factory(Thread::class)->create();


        $reply = factory(Reply::class)->make();



        $this->post($thread->path().'/replies',$reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }
}
