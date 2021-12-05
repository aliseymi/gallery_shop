<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function all(Request $request)
    {
        $products = null;

        if (isset($request->filter, $request->action, $request->range)) {

            $products = $this->findFilterPrice($request?->filter, $request?->action, $request?->range) ?? Product::all();
        } elseif (isset($request->filter, $request->action)) {

            $products = $this->findFilter($request?->filter, $request?->action) ?? Product::all();
        } elseif ($request->has('search')) {

            $products = Product::where('title', 'LIKE', '%' . $request->input('search') . '%')->get();
        } else {

            $products = Product::all();
        }

        $categories = Category::all();

        return view('frontend.products.all', compact('products', 'categories'));
    }

    private function findFilter(string $className, string $methodName)
    {
        $baseNamespace = 'App\Http\Controllers\Filters\\';

        $className = $baseNamespace . (ucfirst($className) . 'Filter');

        if (!class_exists($className)) {
            return null;
        }

        $object = new $className;

        if (!method_exists($object, $methodName)) {
            return null;
        }

        return $object->{$methodName}();
    }

    private function findFilterPrice(string $className, string $methodName, string $range)
    {
        $baseNamespace = 'App\Http\Controllers\Filters\\';

        $className = $baseNamespace . (ucfirst($className) . 'Filter');

        if (!preg_match('/^\d+to\d+$/', $range)) {
            return null;
        }

        $arrayRange = explode('to', $range);

        if($arrayRange[1] < $arrayRange[0]){
            return null;
        }

        if (!class_exists($className)) {
            return null;
        }

        $object = new $className;

        if (!method_exists($object, $methodName)) {
            return null;
        }

        return $object->{$methodName}($range);
    }
}
