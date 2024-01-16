<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::query()->paginate(5);
        return view('products.index', compact('products'));
    }


    public function store(ProductRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $product = new Product($request->except('_token'));

        $this->handleImageUploads($product, $request);

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    private function handleImageUploads(Product $product, ProductRequest $request)
    {
        if ($request->hasFile('feature_image')) {
            $featureImage = $request->file('feature_image')->store('product_images');
            $product->feature_image = $featureImage;
        }

        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImageName = $galleryImage->store('product_images');
                $galleryImages[] = $galleryImageName;
            }
            $product->gallery_images = $galleryImages;
        }
    }

    public function edit($productId): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $product = Product::query()->findOrFail($productId);
        return view('products.partials.edit-form', compact('product'));
    }

    public function update(ProductRequest $request, $productId): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $product = Product::query()->findOrFail($productId);
        $product->update($request->all());
        $this->handleImageUploads($product, $request);
        $product->save();
        return redirect('/products')->with('success', 'Product updated successfully!');
    }

    public function destroy($productId): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $product = Product::query()->findOrFail($productId);

        // Delete images before deleting the product
        $this->deleteProductImages($product);

        $product->delete();

        return redirect('/products')->with('success', 'Product deleted successfully!');
    }

    private function deleteProductImages(Product $product)
    {
        Storage::delete($product->feature_image);

        if ($product->gallery_images) {
            foreach ($product->gallery_images as $galleryImage) {
                Storage::delete($galleryImage);
            }
        }
    }

    public function generatePdf($productId): \Illuminate\Http\Response
    {
        $product = Product::query()->findOrFail($productId);
        $pdf = PDF::loadView('products.pdf', ['product' => $product]);
        return $pdf->download('product.pdf');
    }

}
