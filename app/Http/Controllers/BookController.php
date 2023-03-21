<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\SymfonySkeletonHelper;

class BookController extends Controller
{
	private function getRoutes()
	{
		return [
			'book.index',
			'book.create',
			'book.show'
		];
	}
	
	public function index()
	{
		$routes = [
			'book.index'
		];
		
		return view('book.index', [
			'routes' => $routes
		]);
	}
	
	public function create($aid)
	{
		return view('book.create', [
			'routes' => $this->getRoutes(),
			'aid' => $aid
		]);
	}
	
	public function store(Request $request)
	{
		$validator = \Validator::make(
			$request->all(), [
				   'title' => 'required',
				   'isbn' => 'required',
				   'description' => 'required',
				   'format' => 'required',
				   'number_of_pages' => 'required|integer',
			   ]
		);
		
		if($validator->fails())
		{
			$messages = $validator->getMessageBag();

			return redirect()->back()->with('error', $messages->first());
		}
		
		$data = $request->all();
		unset($data['_token']);

		$data['author']['id'] = (int)$data['author']['id'];
		$data['number_of_pages'] = (int)$data['number_of_pages'];
		
		$book = SymfonySkeletonHelper::createBook($data);
		
		if(!$book){
			return redirect()->back()->with('error', __('Error occured while adding book'));
		}
		
		return redirect()->route('author.show', ['id' => $data['author']['id']])->with('success', __('Book successfully added'));
	}
	
	public function delete(Request $request, $id='')
	{
		$res = SymfonySkeletonHelper::deleteBook($id);
		
		if(!$res){
			return redirect()->back()->with('error', __('Error occured while deleting book'));
		}
		
		return redirect()->back()->with('success', __('Book successfully deleted'));
	}
	
}