<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {

	public function index()
	{
		echo '
			<style>
				.tengah{
					width:100%;
					height:100%;
					text-align:center;
					color: #666;
					font-family: Gadugi;
					font-size: 18px;
				}
			</style>
			<div class="tengah">
				<p>
					<b> Error | 404 </b>
				</p>
			</div>
	
		';
	}

}

/* End of file ErrorY.php */
/* Location: ./application/controllers/ErrorY.php */