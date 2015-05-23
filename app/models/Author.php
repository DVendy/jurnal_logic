<?php

class Author extends Eloquent{
	protected $table = 'author';

	protected $fillable = array('name', 'email');

	public function articles(){
		return $this->belongsToMany('Article')->withTimestamps();
	}
}