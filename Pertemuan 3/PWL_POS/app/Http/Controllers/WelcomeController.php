<?php
namespace App\Http\Controllers;

use App\Charts\registerChart;
use App\Exports\UsersExport;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class WelcomeController extends Controller
{
    public function index(registerChart $chart)
    {
        $breadcrumb = (object) [
            'title' => 'Welcome',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        $members = UserModel::where('status_validasi', 0)->get();

        return view('welcome', ['breadcrumb' => $breadcrumb, 'members' => $members, 'chart' => $chart->build(),'activeMenu' => $activeMenu]);
    }
    public function validateStatus(Request $request, $id){
        $user = UserModel::find($id);

        $user->update([
            'status_validasi'=> 1
        ]);

        return redirect()->route('dashboard');
    }
    public function exportPdf(){
        $members = UserModel::with('level')->whereRelation('level', 'level_nama', 'Member')->get();

        $pdf = Pdf::loadView('memberTable', [
            'members'=> $members, 
            'title'=> 'Data Member'
        ]);
        return response()->streamDownload(function() use($pdf){
            echo $pdf->stream();
        }, 'Daftar Member.pdf');
    }
    public function exportExcel(){
        return Excel::download(new UsersExport, 'Daftar Member.xlsx');
    }
}