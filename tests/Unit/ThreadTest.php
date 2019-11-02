<?php

namespace Tests\Unit;

use App\Reply;
use App\Thread;
use App\User;
use App\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    public function it_has_a_creator()
    {
       $thread = factory(Thread::class)->create();

       $this->assertInstanceOf(User::class,$thread->creator);
    }

    /** @test */
    public function it_can_add_reply()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = factory(Thread::class)->create();


        $thread->addReply([
            'body' => 'my reply',
            'user_id' => 1,
        ]);


       $this->assertCount(1,$thread->replies);


    }

    /** @test  */
    public function a_thread_must_belongs_to_a_channel()
    {

        $this->withoutExceptionHandling();

        $thread = factory(Thread::class)->create();

        $this->assertInstanceOf('App\Channel',$thread->channel);

    }

    /** @test */
    public function it_has_a_path()
    {
        $thread = factory(Thread::class)->create();

        $this->assertEquals($thread->path(),'/threads/'.$thread->channel->slug.'/'.$thread->id);
    }


    /** @test */
    public function it_can_count_its_replies()
    {
        //$this->withoutExceptionHandling();

        $threadWith3Reply = factory(Thread::class)->create();
        $threadWith3Reply->replies()->save(factory(Reply::class)->create());
        $threadWith3Reply->replies()->save(factory(Reply::class)->create());
        $threadWith3Reply->replies()->save(factory(Reply::class)->create());


        $thread = Thread::find($threadWith3Reply->id);

        $this->assertEquals($thread->replies_count,3);

    }



}