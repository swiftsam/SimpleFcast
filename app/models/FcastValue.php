<?php

class FcastValue extends Eloquent {

	public function fcast(){
		return $this->belongs_to('Fcast');
	}

	public function option(){
		return $this->belongs_to('IfpOption');
	}
}

?>