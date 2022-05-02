<?php

namespace App\Http\Controllers\Product;

use App\Helpers\DataTable as HelperDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class ProductListController
 * @package App\Http\Controllers\Product
 */
class ProductListController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        /** @var  $product */
        $product = Product::where('user_id', auth('admin')->id());

        if (isset(request('order')[0]['column']) && isset(request()->order[0]['dir'])) {
            $dir = request()->order[0]['dir'];
            if (request('order')[0]['column'] === 0) {
                $product->orderBy('name', HelperDataTable::sorting($dir));
            }
        }

        if (empty($request->order)) {
            /** @var  $product */
            $product = $product->orderBy('id', 'desc');
        }
        return Datatables::of($product)->make(true);
    }
}
