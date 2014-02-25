<?php

class IfpOption extends Eloquent {
	public function ifp()
	{
		return $this->belongsTo('Ifp');
	}

}

?>