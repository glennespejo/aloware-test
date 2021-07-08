<?php
namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DefaultTableSeeder extends Seeder {
    public function run() {
        //create user
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ];
        $user = User::create($data);

        //create Post
        $faker = Factory::create();
        $post = Post::create([
            'title' => $faker->sentence(5),
            'body' => $faker->paragraph(4)
        ]);

        //create Comment
        Comment::create([
            'post_id'   => $post->id,
            'user_id'   => $user->id,
            'comment'   => 'First Comment!'
        ]);
    }
}
