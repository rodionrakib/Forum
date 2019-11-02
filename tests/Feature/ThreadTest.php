<?php

namespace Tests\Feature;

use App\Channel;
use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;


   /** @test */

   public function a_user_can_create_thread()
   {


       $this->withoutExceptionHandling();

       $this->actingAs(factory(User::class)->create());



       $attr = [
           'title' => 'Syntax  Error',
           'body' => 'here is my code',
           'channel_id' => factory(Channel::class)->create()->id
       ];

       $this->post('/threads',$attr);

       $this->assertDatabaseHas('threads',$attr);
   }

   /** @test */
   public function guest_cannot_create_thread()
   {
       //$this->withoutExceptionHandling();


       $attr = [
           'title' => 'Syntax  Error',
           'body' => 'here is my code'
       ];

       $this->post('/threads',$attr)->assertRedirect('/login');


   }

   /** @test */
   public function a_user_can_brows_threads()
   {

       $this->withoutExceptionHandling();

       $thread = factory(Thread::class)->create();

       $response = $this->get('/threads');

       $response->assertStatus(200);

       $response->assertSee($thread->title);

   }

    /** @test */
    public function a_user_can_brows_a_single_threads()
    {

        $this->withoutExceptionHandling();

        $thread = factory(Thread::class)->create();




        $response = $this->get($thread->path());




        $response->assertStatus(200);

        $response->assertSee($thread->title);

    }

    /** @test */
    public function a_user_can_read_reply_of_a_thread()
    {

        $thread = factory(Thread::class)->create();

        $reply = factory(Reply::class)->create(['thread_id'=> $thread->id]);

        $response = $this->get($thread->path());

        $response->assertSee($reply->body);

    }

    /** @test
     *
     */
    public function a_user_can_brows_single_channel_threads()
    {
        $this->withoutExceptionHandling();

        $threadOfPhp = factory(Thread::class)->create();
        $threadOsJs = factory(Thread::class)->create();

        $php = $threadOfPhp->channel;


        $this->get($php->path())->assertSee($threadOfPhp->title);

        //$this->get($php->path())->assertDontSee($threadOsJs->title);
    }

    /** @test */

    public function threads_can_be_filter_by_username()
    {
        $this->withoutExceptionHandling();

        $jonDoe = factory(User::class )->create();

        $threadeOfJohn = factory(Thread::class)->create(['user_id'=> $jonDoe->id]);
        $anotherTHread = factory(Thread::class)->create();

        $this->get('/threads?by='.$jonDoe->name)
            ->assertSee($threadeOfJohn->title)
            ->assertDontSee($anotherTHread->title);


    }


    /** @test */
    public function threads_can_be_filter_by_popularity()
    {
        $this->withoutExceptionHandling();

        // one that has two and one that one reply

        $threadWith2Reply = factory(Thread::class)->create();
        $r1 = factory(Reply::class)->make(['thread_id'=>$threadWith2Reply->id]);

        $threadWith2Reply->replies()->save($r1);

        $threadWith2Reply->replies()->save(factory(Reply::class)->make(['thread_id'=>$threadWith2Reply->id]));


        $threadWith1Reply = factory(Thread::class)->create();
        $threadWith1Reply->replies()->save(factory(Reply::class)->make(['thread_id'=>$threadWith1Reply->id]));



        // create a thread that has 3 reply
        $threadWith3Reply = factory(Thread::class)->create();
        $threadWith3Reply->replies()->save(factory(Reply::class)->make(['thread_id'=>$threadWith3Reply->id]));
        $threadWith3Reply->replies()->save(factory(Reply::class)->make(['thread_id'=>$threadWith3Reply->id]));
        $threadWith3Reply->replies()->save(factory(Reply::class)->make(['thread_id'=>$threadWith3Reply->id]));

        dd($threadWith3Reply->replies);

        // expected thread order will be thread with 3 reply , 2 , 1
       $response = $this->getJson('/threads?popularity=1')->json();
       $this->assertEquals([3,2,1],array_column($response,'replies_count'));

    }


}
