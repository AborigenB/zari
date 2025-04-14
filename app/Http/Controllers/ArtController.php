<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\ArtImages;
use App\Models\ArtMaterial;
use App\Models\ArtStyle;
use App\Models\ArtTag;
use App\Models\Material;
use App\Models\Style;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtController extends Controller
{
    public function index()
    {
        $arts = Art::orderBy('created_at', 'desc')->take(10)->get();

        return view('pages.index', compact('arts'));
    }
    public function catalog(Request $request)
    {
        $artsQuery = Art::query();

        // Поиск по автору
        if ($author = $request->input('author')) {
            $artsQuery->where('artist', 'like', "%$author%");
        }

        // Получение выбранных фильтров
        $selectedMaterials = $request->input('materials', []);
        $selectedStyles = $request->input('styles', []);
        $selectedTags = $request->input('tags', []);

        // Фильтр по стилям
        if (!empty($selectedStyles)) {
            $artsQuery->whereHas('styles', function ($query) use ($selectedStyles) {
                $query->whereIn('style_id', $selectedStyles);
            });
        }

        // Фильтр по материалам
        if (!empty($selectedMaterials)) {
            $artsQuery->whereHas('materials', function ($query) use ($selectedMaterials) {
                $query->whereIn('material_id', $selectedMaterials);
            });
        }

        // Фильтр по тегам
        if (!empty($selectedTags)) {
            $artsQuery->whereHas('tags', function ($query) use ($selectedTags) {
                $query->whereIn('tag_id', $selectedTags);
            });
        }

        // Фильтр по цене
        if ($minPrice = $request->input('min_price')) {
            $artsQuery->where('price', '>=', $minPrice);
        }
        if ($maxPrice = $request->input('max_price')) {
            $artsQuery->where('price', '<=', $maxPrice);
        }

        // Фильтр по возрасту
        if ($age = $request->input('age')) {
            $artsQuery->where('age', $age);
        }

        // Сортировка по цене
        if ($priceSort = $request->input('price_sort')) {
            if ($priceSort === 'asc') {
                $artsQuery->orderBy('price', 'asc');
            } elseif ($priceSort === 'desc') {
                $artsQuery->orderBy('price', 'desc');
            }
        }

        // Убираем со статусом Не опубликовано
        $artsQuery->where('status', '!=', 'Не опубликовано');

        // Получение данных без пагинации
        $limit = 12;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $limit;

        $arts = $artsQuery->skip($offset)->take($limit)->get();

        // Получение данных для фильтров
        $styles = Style::all();
        $materials = Material::all();
        $tags = Tag::all();

        if ($request->ajax()) {
            return view('components.art-items', compact('arts'));
        }

        return view('pages.arts.catalog', compact('arts', 'styles', 'materials', 'tags', 'selectedStyles', 'selectedMaterials', 'selectedTags'));
    }

    public function likeArt($id){
        // Нужно создать функцию, для обработки добавления в избранное после fetch
        
        return response()->json(['success' => true]);
    }

    public function create()
    {
        $styles = Style::all();
        $materials = Material::all();
        $tags = Tag::all();

        return view('pages.arts.create', compact('styles', 'materials', 'tags'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'images*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'artist' => 'required|string',
            'title' => 'required|string',
            'size' => 'required|',
            'materials*' => 'required',
            'age' => 'required',
            'styles*' => 'required',
            'tags*' => 'required',
            'description' => 'required|',
            'price' => 'required|numeric',
        ], []);

        $data['user_id'] = auth()->user()->id;
        $art = Art::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $url = $image->store('arts', 'public');
                ArtImages::create([
                    'art_id' => $art->id,
                    'url' => $url,
                ]);
            }
        }
        if ($request->has('materials')) {
            foreach ($request->materials as $material) {
                ArtMaterial::create([
                    'art_id' => $art->id,
                    'material_id' => $material
                ]);
            }
        }
        if ($request->has('styles')) {
            foreach ($request->styles as $style) {
                ArtStyle::create([
                    'art_id' => $art->id,
                    'style_id' => $style
                ]);
            }
        }
        if ($request->has('tags')) {
            foreach ($request->tags as $tag) {
                ArtTag::create([
                    'art_id' => $art->id,
                    'tag_id' => $tag
                ]);
            }
        }

        return redirect()->route('catalog');
    }

    public function edit($id)
    {
        $art = Art::find($id);
        $materials = Material::all();
        $styles = Style::all();
        $tags = Tag::all();
        return view('pages.arts.edit', compact('art', 'materials', 'styles', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $art = Art::findOrFail($id);
        $data = $request->validate([
            'images*' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'artist' => 'required|string',
            'title' => 'required|string',
            'size' => 'required',
            'materials*' => 'required|array',
            'age' => 'required',
            'styles*' => 'required|array',
            'tags*' => 'required|array',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // Обновляем основные данные арта
        $art->update([
            'artist' => $data['artist'],
            'title' => $data['title'],
            'size' => $data['size'],
            'age' => $data['age'],
            'description' => $data['description'],
            'price' => $data['price'],
        ]);

        // Обновляем изображения
        if ($request->hasFile('images')) {
            // Удаляем старые изображения, если необходимо
            ArtImages::where('art_id', $art->id)->delete();

            foreach ($request->file('images') as $image) {
                $url = $image->store('arts', 'public');
                ArtImages::create([
                    'art_id' => $art->id,
                    'url' => $url,
                ]);
            }
        }

        // Обновляем материалы
        ArtMaterial::where('art_id', $art->id)->delete();
        foreach ($request->materials as $material) {
            ArtMaterial::create([
                'art_id' => $art->id,
                'material_id' => $material,
            ]);
        }

        // Обновляем стили
        ArtStyle::where('art_id', $art->id)->delete();
        foreach ($request->styles as $style) {
            ArtStyle::create([
                'art_id' => $art->id,
                'style_id' => $style,
            ]);
        }

        // Обновляем теги
        ArtTag::where('art_id', $art->id)->delete();
        foreach ($request->tags as $tag) {
            ArtTag::create([
                'art_id' => $art->id,
                'tag_id' => $tag,
            ]);
        }

        return redirect()->route('art.show', $art)->with('success', 'Арт успешно обновлен');
    }
}
