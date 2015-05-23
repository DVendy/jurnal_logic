<?php

class Keyword extends Eloquent{
	protected $table = 'keyword';

	protected $fillable = array('kata');

	public function articles(){
		return $this->belongsToMany('Article')->withTimestamps();
	}
}