<?php 

class App_extends extends CI_Model {

    public function syncAPI()
	{
		$games = $this->db->get('games');
		$provider = $this->db->get('provedores');

		if($games->num_rows() > 0){
			$this->db->truncate('games');
		}
		if($provider->num_rows() > 0){
			$this->db->truncate('provedores');
		}

		$this->games2api->obterProvedores();
	}
}