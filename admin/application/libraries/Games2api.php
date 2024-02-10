<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Games2api{
    
        public function __construct()
        {
            $this->CI = &get_instance();
            $this->CI->load->helper('url');
            $this->CI->config->item('base_url');
            $this->CI->load->database();
        }
        private function enviarRequest($url, $config) {
            $ch = curl_init();
    
            $headerArray = ['Content-Type: application/json'];
            // Configurando as opções do cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $config);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
            // Executando a requisição e obtendo a resposta
            $response = curl_exec($ch);
    
            // Fechando a conexão cURL
            curl_close($ch);
    
            return $response;
        }
    
        private function getKeys(){
            $this->CI->db->where('id',0);	
            $fiverData = $this->CI->db->get('fiverscan')->result();
    
            $data = array(
                'url' => $fiverData[0]->url,
                'agent_code' => $fiverData[0]->agent_code,
                'agent_token' => $fiverData[0]->agent_token
            );
    
            return $data;
        }

        public function enviarSaldo($id, $saldo){

            $keys = $this->getKeys();
    
            $url = $keys['url']; 
    
            $query['user'] = $this->CI->db->get_where('usuarios', array('id' => $id))->row();
    
            $num = intval($saldo);
    
            // Dados para o corpo da requisição em formato JSON
            $data = array(
                'method' => 'user_deposit',
                'agent_code' => $keys['agent_code'],
                'agent_token' => $keys['agent_token'], 
                'user_code' => $query['user']->usuario,
                "amount" => $num
            );
    
            $json_data = json_encode($data);
    
    
            // Fazendo a requisição POST
            $response = $this->enviarRequest($url, $json_data);
    
            // Exibindo a resposta
    
            $data = json_decode($response, true);
    
            return true;
        }
        public function pegarSaldo(){

                $keys = $this->getKeys();
                $url = $keys['url']; 
        
                // Dados para o corpo da requisição em formato JSON
                $data = array(
                    'method' => 'money_info',
                    'agent_code' => $keys['agent_code'],
                    'agent_token' => $keys['agent_token']
                );
        
                $json_data = json_encode($data);
                log_message('debug','Envio: '. $json_data);
                // Fazendo a requisição POST
                $response = $this->enviarRequest($url, $json_data);
                log_message('debug','Resposta: '. $response);
                // Exibindo a resposta
                $dados = json_decode($response, true);

                if($dados['status'] == 0){
                    return "API desativada";
                }else{

                    return $dados['agent']['balance'];
                }

                
        }

        public function obterProvedores() {

            $keys = $this->getKeys();
    
            $url = $keys['url']; 
    
            $data = array(
                'method' => 'provider_list',
                'agent_code' => $keys['agent_code'],
                'agent_token' => $keys['agent_token'] 
            );
    
            $json_data = json_encode($data);
    
    
            // Fazendo a requisição POST
            $response = $this->enviarRequest($url, $json_data);
    
            // Exibindo a resposta
            $dados = json_decode($response, true);
    
            if ($dados && isset($dados['status']) && $dados['status'] == 1 && isset($dados['providers'])) {
                foreach ($dados['providers'] as $provedor) {
                    // Insere cada provedor na tabela 'provedores'
                    $dados_provedor = array(
                        'code' => $provedor['code'],
                        'name' => $provedor['name'],
                        'type' => $provedor['type'],
                        'status' => $provedor['status']
                    );
    
                    $this->CI->db->insert('provedores', $dados_provedor);
                    $this->obterJogos($provedor['code']);
                }
    
                echo "A lista de jogos foi atualizada com sucesso! <br>";
            } else {
                echo "Os dados da API estão incorretos ou o status não é 1. <br>";
            }
        }
    
        public function obterJogos($provedor) {
            $keys = $this->getKeys();
    
            $url = $keys['url']; 
    
            $data = array(
                'method' => 'game_list',
                'agent_code' => $keys['agent_code'],
                'agent_token' => $keys['agent_token'], 
                "provider_code" =>  $provedor
            );
    
            $json_data = json_encode($data);
    
    
            // Fazendo a requisição POST
            $response = $this->enviarRequest($url, $json_data);
    
            // Exibindo a resposta
            $dados = json_decode($response, true);
    
            if ($dados) {
                foreach ($dados['games'] as $games) {
                    // Insere cada provedor na tabela 'provedores'
                    $dados_provedor = array(
                        'game_code' => $games['game_code'],
                        'game_name' => $games['game_name'],
                        'banner' => $games['banner'],
                        'status' => $games['status'],
                        'provider' => $provedor
                    );
    
                    $this->CI->db->insert('games', $dados_provedor);
                } 
            } 
        }
}