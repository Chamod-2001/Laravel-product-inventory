<?php

namespace App\Http\Controllers;

use App\Models\Category; // Added
use App\Models\Tag; // Added
use App\Models\Product; // Added

use Illuminate\Support\Str; // Added
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products
     */
    public function index() {}


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
        // Validation
        $validated = $request->validate([

            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'

        ]);

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
