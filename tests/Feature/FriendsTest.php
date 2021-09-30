<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FriendsTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_user_can_send_a_friend_request()
    {
        $this->withoutExceptionHandling();
        //creating a friend request to another user

        $this->actingAs($user = factory(User::class)->create(),'api');
        $anotherUser=factory(User::class)->create();

        $response= $this->post('/api/friend-request',[
            'friend_id'=> $anotherUser->id,
        ])->assertStatus(200);
            $friendRequest = \App\Friend::first();
            $this->assertNotNull($friendRequest);
            $this->assertEquals($anotherUser->id, $friendRequest->friend_id);
            $this->assertEquals($user->id, $friendRequest->user_id);
            $response->assertJson([
                'data' =>[
                    'type' => 'friend-request',
                    'friend_request_id'=> $friendRequest->id,
                    'attributes' =>[
                        'confirmed_at' => null,
                    ]
                    ],
                    'links' =>[
                        'self' => url('/users/'.$anotherUser->id),
                    ]
                    ]);

    }

      /** @test */
      public function only_valid_users_can_be_friend_requested()
      {

        $this->actingAs($user = factory(User::class)->create(),'api');

        $response= $this->post('/api/friend-request',[
            'friend_id'=> 123,
        ])->assertStatus(404);

            $this->assertNull(\App\Friend::first());
            $response->assertJson([
                'errors' => [
                    'code'=>404,
                    'title'=>'User Not Found',
                    'detail' => 'Unable to locate the user with the given information'
                ]
                ]);
      }

       /** @test */
    public function friend_requests_can_be_accepted()
    {
        $this->withoutExceptionHandling();
        //creating a friend request to another user
        $this->actingAs($user = factory(\App\User::class)->create(),'api');
        $anotherUser=factory(User::class)->create();
        $this->post('api/friend-request',[
            'friend_id'=> $anotherUser->id,
        ])->assertStatus(200);
        // we act as the other user and accept the friend request
        $response= $this->actingAs($anotherUser,'api')
        ->post('/api/friend-request-response',[
            'user_id'=> $user->id,
            'status'=>1,
        ])->assertStatus(200);
            //we reach to the db and grab the accepted friend request
        $friendRequest = \App\Friend::first();
        //we make sure that the request is completed by checking the confirmed at column
        $this->assertNotNull($friendRequest->confirmed_at);
        //we make sure that the confirmed at column is an instance of carbon so we can manipulate it with diffForHumans and avoid formatting it in the front end
        $this->assertInstanceOf(Carbon::class, $friendRequest->confirmed_at);
        //we make sure that it matches and that we have the correct confirmed at time
        $this->assertEquals(now()->startOfSecond(),$friendRequest->confirmed_at);
        //we make sure that the status passed in the  friend-request-response api call gets saved
        $this->assertEquals(1,$friendRequest->status);

        $response->assertJson([
            'data' =>[
                'type' => 'friend-request',
                'friend_request_id'=> $friendRequest->id,
                'attributes' =>[
                    //we define confirmed_at
                    'confirmed_at' => $friendRequest->confirmed_at->diffForHumans(),
                ]
                ],
                'links' =>[
                    'self' => url('/users/'.$anotherUser->id),
                ]
                ]);

    }

        /** @test */
        public function only_valid_friend_requests_can_be_accepted()
        {
            $anotherUser=factory(User::class)->create();
            $response= $this->actingAs($anotherUser,'api')
            ->post('/api/friend-request-response',[
                'user_id'=> 123,
                'status'=>1,
            ])->assertStatus(404);
            $this->assertNull(\App\Friend::first());
            $response->assertJson([
                'errors' => [
                    'code'=>404,
                    'title'=>'Friend request Not Found',
                    'detail' => 'Unable to locate the friend request with the given information'
                ]
                ]);

        }

             /** @test */
             public function only_the_recipient_can_accept_a_friend_request()
             {
                // this user will make a friend request to another user
                $this->actingAs($user = factory(\App\User::class)->create(),'api');
                $anotherUser=factory(User::class)->create();
                $this->post('api/friend-request',[
                    'friend_id'=> $anotherUser->id,
                ])->assertStatus(200);


                    //we act as a third user
                $response= $this->actingAs(factory(\App\User::class)->create(),'api')
                ->post('/api/friend-request-response',[
                    'user_id'=> $user->id,
                    'status'=>1,
                ])->assertStatus(404);
                $friendRequest = \App\Friend::first();
                $this->assertNull($friendRequest->confirmed_at);
                $this->assertNull( $friendRequest->status);

                $response->assertJson([
                    'errors' => [
                        'code'=>404,
                        'title'=>'Friend request Not Found',
                        'detail' => 'Unable to locate the friend request with the given information'
                    ]
                    ]);

             }
}