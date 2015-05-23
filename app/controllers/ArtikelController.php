<?php

class ArtikelController extends BaseController {

	public function home(){
		$articles = Article::all();
		return View::make('articles.index')->with('articles', $articles)->with('nav', 'home');
	}

	public function showCurrent(){
		$site = Site::first();
		$issue = Issue::find($site->current);
		$articles = $issue->articles;

		//die(var_dump($articles));
		if($articles == null){
			return Redirect::route('archive-home')->with('fail', 'That archive doesn\'t exist')->with('nav', 'home');
		}else
			return View::make('articles.archive_show')->with('articles', $articles)->with('issue', $issue)->with('nav', 'current');
	}

	public function search(){
	    $query = new Article();

		//$query = DB::table('movie');

	    if (Input::has('title')){
	    	$term = Input::get('title');
	    	$term = str_replace(" ", "|", $term);
	    	$query = $query->whereRaw("title regexp '".$term."'")->get();
	    }
	    
	    $jumlah = $query->count();

	    //$movies = $query->paginate(2);
	    //$pagination = $movies->appends(array('title' => Input::get('title')));

	    //return View::make('view', array('movies' => $movies, 'pagination' => $pagination));

		return View::make('articles.result')->with('articles', $query)->with('jumlah', $jumlah)->with('nav', 'home');
	}

	public function supplements(){
		$articles = Article::all();
		$issue = Issue::orderBy('id', 'DESC')->get();

		return View::make('articles.supplement')->with('issue', $issue)->with('articles', $articles)->with('nav', 'supplements');	
	}

	public function archive(){
		$issue = Issue::all();		
		if($issue->count() <= 0){
			return Redirect::route('artikel-home')->with('fail', 'That articles is empty')->with('nav', 'archieve');
		}else{		
			$arr_vol[] = $issue->first()->volume;
			foreach ($issue as $key) {
				if(!in_array($key->volume, $arr_vol))
					$arr_vol[] = $key->volume;
			}
			rsort($arr_vol);

			//die(var_dump($arr_vol));

			return View::make('articles.archive')->with('issue', $issue)->with('arr_vol', $arr_vol)->with('nav', 'archieve');
		}
	}

	public function newArtikel(){
		$issue = Issue::all();

		return View::make('articles.new')->with('issue', $issue)->with('nav', 'archieve');
	}

	public function newIssue(){
		return View::make('articles.new_issue')->with('nav', 'archieve');
	}

	public function showArtikel($id){
		$articles = Article::find($id);
		$articles->hits++;

		if($articles->save()){
			return View::make('articles.article')->with('article', $articles)->with('countAuthor', 1)->with('countKey', 1)->with('nav', 'archieve');
		}else{
			return Redirect::route('artikel-home')->with('fail', "Terjadi error, mohon coba kembali.")->with('nav', 'home');
		}
	}

	public function showArchive($id){
		$issue = Issue::find($id);
		$articles = $issue->articles;

		//die(var_dump($articles));
		if($articles == null){
			return Redirect::route('archive-home')->with('fail', 'That archive doesn\'t exist')->with('nav', 'home');
		}else
			return View::make('articles.archive_show')->with('articles', $articles)->with('issue', $issue)->with('nav', 'archieve');
	}

	public function debugFile(){		
		$destinationPath = 'uploads'; // upload path
		$extension = Input::file('file')->getClientOriginalExtension(); // getting image extension
		$fileName = rand(11111,99999).'.'.$extension; // renaming image
		Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
		// sending back with message		
		return Redirect::route('home')->with('success', 'hmm.')->with('nav', 'home');
	}

	public function downloadArtikel($id){
		if(Input::get('download_captcha') == Input::get('download_key')){
			echo "TRUE";
		}
		else{
			echo "FALSE";
		}
		//die();
		$messages = [
		    'download_name.required' 	=> 'The name field is required.',
		    'download_email.required' 	=> 'The email field is required.',
		    'download_phone.required' 	=> 'The phone field is required.',
		    'download_agency.required' 	=> 'The agency field is required.',
		    'download_captcha.required' => 'The security check is required.',
		    'download_name.min' 		=> 'The name field must be at least 4 characters.',
		    'download_email.min' 		=> 'The email field must be at least 3 characters.',
		    'download_phone.min' 		=> 'The phone field must be at least 3 characters.',
		    'download_agency.min' 		=> 'The agency field must be at least 3 characters.',
		    'download_captcha.same' 	=> 'Security check failed.'
		];

		$validate = Validator::make(Input::all(), array(
				'download_name' 	=> 'required|min:4',
				'download_email' 	=> 'required|min:3',
				'download_phone' 	=> 'required|min:3',
				'download_agency' 	=> 'required|min:3',
				'download_captcha' 	=> 'required|same:download_key'
			), $messages);

		if ($validate -> fails()){
			return Redirect::route('artikel-show', $id)->withErrors($validate)->withInput()->with('modal', '#group_form')->with('nav', 'archieve');
		}else{
			$downloader = new Downloader;
			$downloader->name = Input::get('download_name');			
			$downloader->email = Input::get('download_email');			
			$downloader->phone = Input::get('download_phone');	
			

			$file= "uploads/" . $id . ".pdf";
			$article = Article::find($id);
			$article->downloads++;
			if($article->save() && $downloader->save()){
				$article->downloaders()->attach($downloader->id);
				return Response::download($file);		
			}else{			
				return Redirect::route('artikel-home')->with('fail', "Terjadi error, mohon coba kembali.")->with('nav', 'home');
			}		
		}
	}	

	public function storeArtikel(){		
		// $myArray = explode(',', Input::get('keywords'));

		// $i = 0;
		// foreach ($myArray as $key) {
		// 	$myArray[$i] = trim($key);
		// 	$i++;
		// }

		// die(var_dump($myArray));

		$messages = [
		    'author.0.required' => 'The author field is required.',
		    'email.0.required' => 'The email field is required.',
		];

		$validate = Validator::make(Input::all(), array(
				'title' 	=> 'required|min:4',
				'abstract' 	=> 'required|min:3',
				'file' 		=> 'required|mimes:pdf',
				'datepicker'=> 'required',
				'author.0' 	=> 'required|min:3',
				'email.0'  	=> 'required|min:3'
			), $messages);

		if ($validate -> fails()){
			return Redirect::route('artikel-new')->withErrors($validate)->withInput()->with('nav', 'archieve');
		}
		else{			
			$destinationPath = 'file_artikel';

			$artikel = new Article;
			$artikel->title = Input::get('title');			
			$artikel->abstract = Input::get('abstract');			
			$artikel->date = Input::get('datepicker');		
			$artikel->issue_id = Input::get('issue');

			$a_name = Input::get('author');
			$a_email = Input::get('email');

			for ($x = 0; $x < count($a_name); $x++) {
				$a = Author::firstOrNew(array(
					'name' => $a_name[$x],
					'email' => $a_email[$x]
					));

			    $authors[$x] = $a;
			} 							
			$save_auth = true;
			foreach ($authors as $key) {
				if(!$key->save())
					$save_auth = false;
			}

			$myArray = explode(',', Input::get('keywords'));
			$i = 0;
			foreach ($myArray as $key) {
				$myArray[$i] = trim($key);
				$i++;
			}
			for ($x = 0; $x < count($myArray); $x++) {
				if (strlen($myArray[$x]) > 0 ){
					$a = Keyword::firstOrNew(array(
					'kata' => $myArray[$x]
					));

				    $keywords[$x] = $a;
				}
			} 
			$save_key = true;
			foreach ($keywords as $key) {
				if(!$key->save())
					$save_key = false;
			}


			if ($artikel->save() && $save_auth && $save_key){
				$destinationPath = 'uploads';
				$extension = Input::file('file')->getClientOriginalExtension();
				$fileName = $artikel->id.'.'.$extension;
				Input::file('file')->move($destinationPath, $fileName);

				$artikel->file = $artikel->id;										
				if($artikel->save()){
					foreach ($authors as $key) {
						$artikel->authors()->attach($key->id);
					}				
					foreach ($keywords as $key) {
						$artikel->keywords()->attach($key->id);
					}			
					return Redirect::route('artikel-home')->with('success', 'Artikel berhasil ditambahkan')->with('nav', 'archieve');							
				}else{
					return Redirect::route('artikel-home')->with('fail', 'An error occured bro!')->with('nav', 'archieve');		
				}
			}
			else{
				return Redirect::route('artikel-home')->with('fail', 'An error occured bro!')->with('nav', 'archieve');	
			}
		}
	}

	public function storeIssue(){		
		// $myArray = explode(',', Input::get('keywords'));

		// $i = 0;
		// foreach ($myArray as $key) {
		// 	$myArray[$i] = trim($key);
		// 	$i++;
		// }

		// die(var_dump($myArray));

		$validate = Validator::make(Input::all(), array(
				'year' 		=> 'required',
				'month'=> 'required',
				'volume'	=> 'required'
			));

		if ($validate -> fails()){
			return Redirect::route('artikel-new-issue')->withErrors($validate)->withInput()->with('nav', 'archieve');
		}
		else{			
			$issue = new Issue;
			$issue->year = Input::get('year');			
			$issue->volume = Input::get('volume');			
			$issue->month = Input::get('month');
			$issue->number = Input::get('number');

			if ($issue->save()){				
				return Redirect::route('artikel-home')->with('success', 'Artikel berhasil ditambahkan')->with('nav', 'archieve');
			}
			else{
				return Redirect::route('artikel-home')->with('fail', 'An error occured bro!')->with('nav', 'archieve');	
			}
		}
	}

	public function deleteArtikel($id){
		$article = Article::find($id);
		if($article == null){
			return Redirect::route('artikel-home')->with('fail', "Artikel tersebut tidak tersedia.")->with('nav', 'archieve');
		}

		$author = $article->authors;		

		$destinationPath = 'uploads/';		
		$fileName = $article->id.'.pdf';		

		foreach ($author as $key) {
			$article->authors()->detach($key->id);
		}		

		if($article->delete() && File::delete($destinationPath . $fileName)){			
			return Redirect::route('artikel-home')->with('success', 'Artikel berhasil dihapus.')->with('nav', 'archieve');
		}else{
			return Redirect::route('artikel-home')->with('fail', 'An error occured.')->with('nav', 'archieve');
		}
	}
}
