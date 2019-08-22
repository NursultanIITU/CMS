<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Post;
use App\Tag;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1=Category::create([
           'name' => 'News'
        ]);

        $category2=Category::create([
            'name' => 'Marketing'
        ]);

        $category3=Category::create([
            'name' => 'Partnership'
        ]);

        $author1= \App\User::create([
            'name' =>'Nursultan Beisenov',
            'email' => 'nursb@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password')
        ]);

        $author2= \App\User::create([
            'name' =>'Elaman Baimukhan',
            'email' => 'ela@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password')
        ]);

        $author3= \App\User::create([
            'name' =>'Gulka Mukhametkali',
            'email' => 'gulka@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password')
        ]);

        $post1=Post::create([
           'title' => 'We relocated our office to a new designed garage',
           'description' => 'The ume 1914 translation by H. Rackham.',
           'content' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney Colerature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
           'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
            'user_id' => $author1->id
        ]);

        $post2=$author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'The standard nd 1.10.33 from orig H. Rackham.',
            'content' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney Colerature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg'
        ]);

        $post3=$author3->posts()->create([
            'title' => 'Best practices for minimalist design with example   ',
            'description' => 'The et Malorum" by Cicero are also reproduced in their exact original versionby H. Rackham.',
            'content' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney Colerature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg'
        ]);

        $post4=$author1->posts()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'The standard chunk of Lorem. Sections 1.10.32 and reproduced in by English versionsn by H. Rackham.',
            'content' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney Colerature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.',
            'category_id' => $category1->id,
            'image' => 'posts/4.jpg'
        ]);


        $tag1=Tag::create([
           'name' => 'Job'
        ]);

        $tag2=Tag::create([
            'name' => 'Record'
        ]);

        $tag3=Tag::create([
            'name' => 'Customers'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag3->id, $tag2->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
    }
}
