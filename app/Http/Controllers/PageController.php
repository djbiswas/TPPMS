<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Support\Company;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('public.page', [
            'page' => $page,
            'title' => $page->meta_title ?: $page->title,
            'metaDescription' => $page->meta_description ?: Company::get('meta_description'),
            'ogImage' => $page->ogImageUrl() ?: Company::mediaUrl(Company::get('og_image')),
        ]);
    }
}
