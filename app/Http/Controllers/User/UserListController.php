<?php

namespace App\Http\Controllers\User;

use App\Enums\UserType;
use App\Helpers\DataTable as HelperDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class UserListController
 * @package App\Http\Controllers\User
 */
class UserListController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function get(Request $request)
    {
        /** @var  $user */
        $user = User::where('type', UserType::USER);

        if (isset(request('order')[0]['column']) && isset(request()->order[0]['dir'])) {
            $dir = request()->order[0]['dir'];
            if (request('order')[0]['column'] === 0) {
                $user->orderBy('first_name', HelperDataTable::sorting($dir));
            } else if (request('order')[0]['column'] === 1) {
                $user->orderBy('last_name', HelperDataTable::sorting($dir));
            }
        }

        if (empty($request->order)) {
            /** @var  $user */
            $user = $user->orderBy('id', 'desc');
        }
        return Datatables::of($user)->make(true);
    }
}
