<?php

class Fcast extends Eloquent {
	public function values(){
		return $this->has_many('FcastValue');
	}

	public function user(){
		return $this->belongs_to('User');		
	}

	public function ifp(){
		return $this->belongs_to('Ifp');		
	}
}

?>