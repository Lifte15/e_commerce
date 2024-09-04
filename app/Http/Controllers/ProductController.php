<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $products = Product::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('product_name', 'like', '%' . $query . '%');
        })->paginate(12);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function helloworl()
    {
        return view('products.helloworl');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => [
                'required',
                'min:3',
                'unique:products,product_name',
                function ($attribute, $value, $fail) {
                    if (strlen($value) > 255) {
                        $fail("What the! Are you writing a short story? Keep it under 255 characters!");
                    }
                }
            ],
            'price' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^\d{1,6}(\.\d{1,2})?$/', $value)) {
                        $fail("Seriously? No one gonna buy that! You Money-hungry.");
                    } elseif ($value <= 0) {
                        $fail("Come on, make it a positive price! You're not a charity.");
                    }
                }
            ],
            'stock' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (strlen((string) $value) > 11) {
                        $fail("You planning to stock up for the apocalypse?");
                    } elseif ($value <= 0) {
                        $fail("Stock can't be zero or negative! You psycho.");
                    }
                }
            ],
        ]);


        $imagePath = null;
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
        }

        Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => [
                'required',
                'min:3',
                'unique:products,product_name,' . $id,
                function ($attribute, $value, $fail) {
                    if (strlen($value) > 255) {
                        $fail("What the! Are you writing a short story? Keep it under 255 characters!");
                    }
                }
            ],
            'price' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^\d{1,6}(\.\d{1,2})?$/', $value)) {
                        $fail("Seriously? No one gonna buy that! You Money-hungry.");
                    } elseif ($value <= 0) {
                        $fail("Come on, make it a positive price! You're not a charity.");
                    }
                }
            ],
            'stock' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (strlen((string) $value) > 11) {
                        $fail("You planning to stock up for the apocalypse?");
                    } elseif ($value <= 0) {
                        $fail("Stock can't be zero or negative! You psycho.");
                    }
                }
            ],
        ]);
    
        $product = Product::findOrFail($id);
    
        if ($request->hasFile('product_image')) {
            // Delete old image if exists
            if ($product->product_image) {
                \Storage::delete('public/' . $product->product_image);
            }
    
            // Store new image
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $product->product_image = $imagePath;
        }
    
        // Update product details
        $product->product_name = $request->product_name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        
        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
// its not working properly