<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $products = $query->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403, 'Unauthorized access');
        return view('products.create');
    }

    /**
     * Store a newly created product in database.
     */
    public function store(Request $request)
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403, 'Unauthorized access');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string',
            'new_image_urls.*' => 'nullable|url'
        ]);

        $product = Product::create($validated);

        if ($request->has('new_image_urls')) {
            foreach ($request->input('new_image_urls') as $url) {
                if (!empty($url)) {
                    $product->images()->create([
                        'image_path' => $url
                    ]);
                }
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403, 'Unauthorized access');
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in database.
     */
    public function update(Request $request, Product $product)
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403, 'Unauthorized access');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string',
            'new_image_urls.*' => 'nullable|url',
            'existing_images.*' => 'nullable|url'
        ]);

        $product->update($validated);

        // Handle existing images
        if ($request->has('existing_images')) {
            $existingIds = array_keys($request->input('existing_images'));
            
            // Delete images that were removed from the UI
            $product->images()->whereNotIn('id', $existingIds)->get()->each(function ($img) {
                if (str_starts_with($img->image_path, '/storage/')) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $img->image_path));
                }
                $img->delete();
            });

            // Update remaining ones
            foreach ($request->input('existing_images') as $id => $url) {
                if (empty($url)) {
                    $img = $product->images()->find($id);
                    if ($img) {
                        if (str_starts_with($img->image_path, '/storage/')) {
                            Storage::disk('public')->delete(str_replace('/storage/', '', $img->image_path));
                        }
                        $img->delete();
                    }
                } else {
                    $product->images()->where('id', $id)->update(['image_path' => $url]);
                }
            }
        } else {
            // Unset all existing if empty
            $product->images->each(function ($img) {
                if (str_starts_with($img->image_path, '/storage/')) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $img->image_path));
                }
                $img->delete();
            });
        }

        // Handle new image URLs
        if ($request->has('new_image_urls')) {
            foreach ($request->input('new_image_urls') as $url) {
                if (!empty($url)) {
                    $product->images()->create([
                        'image_path' => $url
                    ]);
                }
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from database.
     */
    public function destroy(Product $product)
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403, 'Unauthorized access');

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }

    /**
     * Remove a specific product image.
     */
    public function destroyImage(ProductImage $image)
    {
        abort_unless(auth()->check() && auth()->user()->isAdmin(), 403, 'Unauthorized access');

        try {
            // Extract path from URL to delete from storage
            $path = str_replace('/storage/', '', $image->image_path);
            Storage::disk('public')->delete($path);
            
            $image->delete();

            return back()->with('success', 'Image removed successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to remove image: ' . $e->getMessage()]);
        }
    }
}
