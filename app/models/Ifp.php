<?php

class Ifp extends Eloquent {

    public function css_class()
    {
        switch ($this->status) {
        	case '0':
        		$class = "warning";
        		break;
        	case '1':
        		$class = "success";
        		break;
        	case '2':
        	case '3':
        		$class = "info";
        		break;
        	case '4':
        		$class = "danger";
        		break;
        	default:
        		$class = "";
        		break;
        }
        return($class);
    }

    public function status_verbal()
    {
        switch ($this->status) {
        	case '0':
        		$verbal = "Void";
        		break;
        	case '1':
        		$verbal = "Active";
        		break;
        	case '2':
        		$verbal = "Suepended";
        		break;
        	case '3':
        		$verbal = "Pending";
        		break;
        	case '4':
        		$verbal = "Closed";
        		break;
        	default:
        		$verbal = "";
        		break;
        }
        return($verbal);
    }
}

?>