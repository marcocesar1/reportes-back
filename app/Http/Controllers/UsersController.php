<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 25);
        $search = $request->get('search');

        $baseQuery = User::with('address')
                    ->when($search, function($query) use ($search){
                        $query->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                    });                    

        if($request->isPdf){
            $users = $baseQuery->get();

            $pdf = Pdf::loadView('pdf.users', ['users' => $users]);
            return $pdf->download('users-report.pdf');
        }

        if($request->isExcel) {
            $users = $baseQuery->get();

            return Excel::download(new UsersExport($users), 'users-report.xlsx');
        };

        $users = $baseQuery->paginate($perPage);

        return response()->json($users);
    }
}
