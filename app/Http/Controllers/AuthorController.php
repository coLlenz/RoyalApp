<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SymfonySkeletonHelper;

class AuthorController extends Controller
{
	private function getRoutes()
	{
		return [
			'author.index',
			'author.create',
			'author.show'
		];
	}
	
	public function index()
	{
		$authors = SymfonySkeletonHelper::getAuthors();
		
		return view('author.index', [
			'routes' => $this->getRoutes(),
			'authors' => $authors
		]);
	}
	
	public function show($id='')
	{
		$author = SymfonySkeletonHelper::getAuthor($id);
		
		if(!$author){
			return abort('404');
		}
		
		return view('author.show', [
			'routes' => $this->getRoutes(),
			'author' => $author
		]);
	}
	
	public function create()
	{
		return view('author.create', [
			'routes' => $this->getRoutes(),
		]);
	}
	
	public function store(Request $request)
	{
		$validator = \Validator::make(
			$request->all(), [
				   'first_name' => 'required',
				   'last_name' => 'required',
				   'birthday' => 'required',
				   'gender' => 'required',
				   'place_of_birth' => 'required',
			   ]
		);
		
		if($validator->fails())
		{
			$messages = $validator->getMessageBag();

			return redirect()->back()->with('error', $messages->first());
		}
		
		$data = $request->all();
		unset($data['_token']);

		$author = SymfonySkeletonHelper::createAuthor($data);
		
		if(!$author){
			return redirect()->back()->with('error', __('Error occured while adding author'));
		}
		
		return redirect()->back()->with('success', __('Author successfully added'));
	}
	
	public function delete(Request $request, $id='')
	{
		$res = SymfonySkeletonHelper::deleteAuthor($id);
		
		if(!$res){
			return redirect()->back()->with('error', __('Error occured while deleting author'));
		}
		
		return redirect()->back()->with('success', __('Author successfully deleted'));
	}
}