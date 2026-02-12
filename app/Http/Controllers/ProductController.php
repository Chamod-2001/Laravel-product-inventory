<?php

namespace App\Http\Controllers;

use App\Models\Category; // Added
use App\Models\Tag; // Added
use App\Models\Product; // Added

use Illuminate\Support\Str; // Added
use Illuminate\Support\Facades\Storage; // Added
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products
     */
    public function index()
    {
        // Eager loading(latest products with category and tags) to prevent N+1 problem (join), Retrieves all products with their related category and tags, Products are ordered by latest created
        $products = Product::with(['category', 'tags'])->latest()->get();

        return view('products.index', compact('products')); //passed to the index view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Loads categories and tags from database and sends them to the product create page, then user can choose them
        $categories = Category::all();
        $tags = Tag::all();

        return view('products.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd('Store method reached'); // debug

        // Validation
        $validated = $request->validate([

            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|mimetypes:image/jpeg,image/png|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'

        ]);

        // logger($validated);


        // SKU auto generated unique 8 character string
        if (empty($validated['sku'])) {
            do { // why - loop keep looking generated code until find unique one (DB not store duplicate key)
                $sku = Str::upper(Str::random(8)); // Random 8 chracter and Convert them into the uppercase
            } while (Product::where('sku', $sku)->exists()); // Check sku is exists in product table

            $validated['sku'] = $sku; //Save the validated sku
        }

        // Store Image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');

            $validated['image_path'] = $path; //Save the validated path
        }

        // Create Product
        $product = Product::create($validated);
        // dd($product);

        // Attach Tags (M:N)
        if ($request->has('tags')) {
            $product->tags()->attach($request->tags);
        }

        // Redirect success page (product.index)
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::with('tags')->findOrFail($id); // find related product using product_id | if not found 404 error | "with('tags')" eager load product tag for pre check
        $categories = Category::all(); //load all category
        $tags = Tag::all(); //load all tag

        return view('products.edit', compact('product', 'categories', 'tags')); //passed to edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|mimetypes:image/jpeg,image/png|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        // Replace Image if uploaded
        if ($request->hasFile('image')) {

            // Delete old image
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $product->update($validated);

        // Sync tags (important!)
        $product->tags()->sync($request->tags ?? []);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);

        $product->delete(); // Soft delete

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * SoftDelete product storage.
     */
    public function trash()
    {
        $products = Product::onlyTrashed()
            ->with(['category', 'tags'])
            ->latest()
            ->get();

        return view('products.trash', compact('products'));
    }

    /**
     * SoftDelete product restore storage.
     */
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        $product->restore();

        return redirect()->route('products.trash')
            ->with('success', 'Product restored successfully.');
    }
}
