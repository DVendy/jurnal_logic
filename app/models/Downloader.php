<?php

class Downloader extends Eloquent{
	protected $table = 'downloader';

	public function articles(){
		return $this->belongsToMany('Article')->withTimestamps();
	}
}