<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\ImageProcessor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => Page::query()->orderBy('title')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.form', ['page' => new Page]);
    }

    public function store(Request $request, ImageProcessor $images): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['og_image'], $data['og_image_data']);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['og_image'] = $images->store($request->input('og_image_data') ?: $request->file('og_image'), 'pages', 1200, 630, true);

        Page::query()->create($data);

        return redirect()->route('admin.pages.index')->with('status', 'Page created.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.form', ['page' => $page]);
    }

    public function update(Request $request, Page $page, ImageProcessor $images): RedirectResponse
    {
        $data = $this->validated($request, $page->id);
        unset($data['og_image'], $data['og_image_data']);
        if ($page->isProtected()) {
            $data['slug'] = $page->slug;
        } else {
            $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        }
        $data['is_published'] = $request->boolean('is_published');

        $og = $images->store($request->input('og_image_data') ?: $request->file('og_image'), 'pages', 1200, 630, true);
        if ($og) {
            $data['og_image'] = $og;
        }
        if ($request->boolean('og_image_remove')) {
            $data['og_image'] = null;
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('status', 'Page saved.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        abort_if($page->isProtected(), 403);

        $page->delete();

        return redirect()->route('admin.pages.index')->with('status', 'Page deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:80', 'alpha_dash', Rule::unique('pages', 'slug')->ignore($ignoreId)],
            'body' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:180'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'max:5120'],
            'og_image_data' => ['nullable', 'string'],
        ]);
    }
}
