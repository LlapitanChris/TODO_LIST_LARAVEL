<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Category;

class CategoryController extends Controller

{
	function sortCategories($id){
		$category = Category::find($id);
	
		$items = $category->items;

		return view('show_items', compact('items'));
	}


	function categoryDetails($id){
		$category = Category::find($id);
		// dd($category); //drydump
		return view('items.category_details', compact('category'));
	}

}