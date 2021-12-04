<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Utilities\ImageUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreRequest;
use App\Http\Requests\Admin\Products\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function all()
    {
        $products = Product::paginate(10);

        return view('admin.products.all', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        $admin = User::where('email', 'admin@gmail.com')->first();

        $product = Product::create([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'owner_id' => $admin->id
        ]);


        // try {
        //     $basePath = 'images/products/' . $product->id;

        //     $sourceImageFullPath = $basePath . '/source_url_' . $validatedData['source_url']->getClientOriginalName();

        //     $images = [
        //         'thumbnail_url' => $validatedData['thumbnail_url'],
        //         'demo_url' => $validatedData['demo_url']
        //     ];

        //     $imagesPath = ImageUploader::uploadMany($images, $basePath);
        //     ImageUploader::upload($validatedData['source_url'], $sourceImageFullPath, 'local_storage');

        //     $updated = $product->update([
        //         'thumbnail_url' => $imagesPath['thumbnail_url'],
        //         'demo_url' => $imagesPath['demo_url'],
        //         'source_url' => $sourceImageFullPath,
        //     ]);

        //     if (!$updated) {
        //         throw new Exception('عکس ها آپلود نشدند');
        //     }

        //     return back()->with('success', 'محصول ایجاد شد');
        // } catch (Exception $e) {
        //     return back()->with('failed', $e->getMessage());
        // }

        if(!$this->uploadImages($validatedData, $product)){
            return back()->with('failed', 'محصول ایجاد نشد');
        }

        return back()->with('success', 'محصول ایجاد شد');

    }

    public function downloadDemo($product_id)
    {
        $product = Product::findOrFail($product_id);

        return response()->download(public_path($product->demo_url));
    }

    public function downloadSource($product_id)
    {
        $product = Product::findOrFail($product_id);

        return response()->download(storage_path('app/local_storage/' . $product->source_url));
    }

    public function edit($product_id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($product_id);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateRequest $request, $product_id)
    {
        $validatedData = $request->validated();

        $product = Product::findOrFail($product_id);

        $updatedProduct = $product->update([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
        ]);

        if(!$this->uploadImages($validatedData, $product) or !$updatedProduct){
            return back()->with('failed', 'تصاویر آپلود نشدند');
        }

        return back()->with('success', 'بروزرسانی انجام شد');
    }

    public function delete($product_id)
    {
        $product = Product::findOrFail($product_id);

        $product->delete();

        return back()->with('success', 'محصول حذف شد');
    }

    private function uploadImages($validatedData, $product)
    {
        try {
            $basePath = 'images/products/' . $product->id;

            $sourceImageFullPath = null;

            $data = [];

            if (isset($validatedData['source_url'])) {
                $sourceImageFullPath = $basePath . '/source_url_' . $validatedData['source_url']->getClientOriginalName();

                ImageUploader::upload($validatedData['source_url'], $sourceImageFullPath, 'local_storage');

                $data += ['source_url' => $sourceImageFullPath];
            }

            if(isset($validatedData['thumbnail_url'])){
                $fullPath = $basePath . '/thumbnail_url_' . $validatedData['thumbnail_url']->getClientOriginalName();

                ImageUploader::upload($validatedData['thumbnail_url'], $fullPath, 'public_storage');

                $data += ['thumbnail_url' => $fullPath];
            }

            if(isset($validatedData['demo_url'])){
                $fullPath = $basePath . '/demo_url_' . $validatedData['demo_url']->getClientOriginalName();

                ImageUploader::upload($validatedData['demo_url'], $fullPath, 'public_storage');

                $data += ['demo_url' => $fullPath];
            }
            

            $updated = $product->update($data);

            if (!$updated) {
                throw new Exception('عکس ها آپلود نشدند');
            }

            return true;

        } catch (Exception $e) {
            return false;
        }
    }
}
