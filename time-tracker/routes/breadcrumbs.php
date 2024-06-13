<?php

// routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// // Home > About
// Breadcrumbs::for('about', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('About', route('about'));
// });

// // Home > Blog > [Post]
// Breadcrumbs::for('post', function (BreadcrumbTrail $trail, $post) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog.index'));
//     $trail->push($post->title, route('post.show', $post));
// });

