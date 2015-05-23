<?php

class Issue extends Eloquent{
	protected $table = 'issue';

	public function articles(){
		return $this->hasMany('Article');
	}
}