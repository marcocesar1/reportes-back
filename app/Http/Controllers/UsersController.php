<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends Controller
{
    //
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $search = $request->get('search');

        $queryBase = User::with('address')
                    ->when($search, function($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                    });
                    
        if($request->header('Is-Pdf'))  {
            $users = $queryBase->get();

            $pdf = Pdf::loadView('pdf.users', compact('users'));
            return $pdf->download('users.pdf');
        };
        
        if($request->header('Is-Excel')) {
            $users = $queryBase->get();

            return Excel::download(new UsersExport($users), 'users.xlsx');
        };

        $users = $queryBase->paginate($perPage);

        return response()->json($users);
    }
}
