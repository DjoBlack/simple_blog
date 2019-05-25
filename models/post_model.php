<?php

class Post
{
	protected $defaultFormat = 'Y-m-d H:i:s';

	public function date($formatTo = 'd M / Y') {
		
		$dateObj = DateTime::createFromFormat($this->defaultFormat, $this->date);

		return $dateObj->format($formatTo);
	}

	public function preview($len = 50) {
		if (strlen($this->post_body) >= $len) {
			return substr($this->post_body, 0, $len) . '...';
		}

		return $this->post_body;
	}	

}