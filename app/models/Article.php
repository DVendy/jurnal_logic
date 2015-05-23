<?php

class Article extends Eloquent{
	protected $table = 'article';

	public function authors(){
		return $this->belongsToMany('Author')->withTimestamps();
	}

	public function downloaders(){
		return $this->belongsToMany('Downloader')->withTimestamps();
	}

	public function keywords(){
		return $this->belongsToMany('Keyword')->withTimestamps();
	}

	public function issue(){
		return $this->belongsTo('Issue');
	}
}