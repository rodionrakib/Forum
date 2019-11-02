<?php

namespace Tests\Unit;

use App\Channel;
use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChannelTest extends TestCase
{

    use RefreshDatabase;


   /** @test */
   public function a_thread_has_a_path()
   {

        $channel = factory(Channel::class)->create();

        $this->assertEquals($channel->path(),'threads/'.$channel->slug);


   }
}
