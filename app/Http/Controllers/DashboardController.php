<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SymfonySkeletonHelper;

class DashboardController extends Controller
{
	public function index()
	{
		$routes = [
			'dashboard.index'
		];
		
		return view('dashboard.index', [
			'routes' => $routes,
			'user_data' => session()->get('user_data')
		]);
	}
	
}