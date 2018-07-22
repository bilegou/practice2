<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $user = $users->find(1);

        $user_id = $user->id;

        $followers  =  $users->slice($user_id);

        //所谓的pluck就是把这个参数挑出来单挑。
        $follower_ids = $followers->pluck('id')->toArray();
        
        //挑出来后，一个个握手加好友。
        $user->follow($follower_ids);

        //这里需要先遍历followers，$user已经是主角，followers为群众，让群众全部关注主角首先先得遍历。
        foreach ($followers as $follower) {
        	$follower->follow($user_id);
        }
    }
}
