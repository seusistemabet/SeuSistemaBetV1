
<?php 
require_once APPPATH .'models/App_extends.php';  

class App_model extends App_extends {

    public function nomeSistema()
	{
		$this->db->where('id',0);	
		return $this->db->get('config')->row()->nome;
	}
	public function logo()
	{
		$this->db->where('id',0);	
		return $this->db->get('config')->row()->logo;
	}
	public function getStatistics() {
        $query = $this->db->query("
        SELECT
            -- L U C R O S   - -
            -- LUCRO 24H
            (SELECT SUM(CASE WHEN tipo = 'deposito' THEN valor ELSE 0 END) - 
                    SUM(CASE WHEN tipo = 'saque'    THEN valor ELSE 0 END) AS LUCRO_24H 
                FROM transacoes 
                WHERE data_hora >= NOW() - INTERVAL 24 HOUR 
                    AND STATUS = 'pago'
                    AND VALOR IS NOT NULL) as LUCRO_24H,
            -- LUCRO 7 DIAS
            (SELECT SUM(CASE WHEN tipo = 'deposito' THEN valor ELSE 0 END) - 
                    SUM(CASE WHEN tipo = 'saque'    THEN valor ELSE 0 END) AS LUCRO_7D
                FROM transacoes 
                WHERE data_hora >= NOW() - INTERVAL 7 DAY 
                    AND STATUS = 'pago'
                    AND VALOR IS NOT NULL) as LUCRO_7D,
            -- LUCRO 1 MES
            (SELECT SUM(CASE WHEN tipo = 'deposito' THEN valor ELSE 0 END) - 
                    SUM(CASE WHEN tipo = 'saque'    THEN valor ELSE 0 END) AS LUCRO_1M
                FROM transacoes 
                WHERE data_hora >= NOW() - INTERVAL 30 DAY
                    AND STATUS = 'pago'
                    AND VALOR IS NOT NULL) as LUCRO_1M,
            -- LUCRO TOTAL
            (SELECT SUM(CASE WHEN tipo = 'deposito' THEN valor ELSE 0 END) - 
                    SUM(CASE WHEN tipo = 'saque'    THEN valor ELSE 0 END) AS LUCRO_TOTAL 
                FROM transacoes
                WHERE STATUS = 'pago'
                    AND VALOR IS NOT NULL ) as LUCRO_TOTAL,
            -- D E P O S I T O S   - -
            -- DEPOSITO 24H
            (SELECT SUM(CASE WHEN tipo = 'deposito' THEN valor ELSE 0 END) AS DEPOSITOS_24H 
                FROM transacoes 
                WHERE data_hora >= NOW() - INTERVAL 24 HOUR
                    AND STATUS = 'pago'
                    AND VALOR IS NOT NULL) as DEPOSITOS_24H,
            -- DEPOSITO 7D
            (SELECT SUM(CASE WHEN tipo = 'deposito' THEN valor ELSE 0 END) AS DEPOSITOS_7D
                FROM transacoes 
                WHERE data_hora >= NOW() - INTERVAL 7 DAY
                    AND STATUS = 'pago'
                    AND VALOR IS NOT NULL) as DEPOSITOS_7D,
            -- DEPOSITO 1M
            (SELECT SUM(CASE WHEN tipo = 'deposito' THEN valor ELSE 0 END) AS DEPOSITOS_1M
                FROM transacoes 
                WHERE data_hora >= NOW() - INTERVAL 30 DAY
                    AND STATUS = 'pago'
                    AND VALOR IS NOT NULL) as DEPOSITOS_1M,
            -- DEPOSITO TOTAL
            (SELECT SUM(CASE WHEN tipo = 'deposito' THEN valor ELSE 0 END) AS DEPOSITOS_TOTAL
                FROM transacoes 
                WHERE STATUS = 'pago'
                    AND VALOR IS NOT NULL) as DEPOSITOS_TOTAL,
            -- P I X
            -- PIX_GERADOS_24H
            (SELECT COUNT(*) AS PIXS_GERADOS_24H 
                FROM transacoes
                WHERE tipo = 'deposito' 
                    AND VALOR IS NOT NULL
                    AND data_hora >= NOW() - INTERVAL 24 HOUR) as PIXS_GERADOS_24H,
            -- PIX_PAGOS_24H
            (SELECT COUNT(*) AS PIXS_PAGOS_24H 
                FROM transacoes
                WHERE tipo = 'deposito' 
                    AND STATUS = 'pago'
                    AND VALOR IS NOT NULL
                    AND data_hora >= NOW() - INTERVAL 24 HOUR) as PIXS_PAGOS_24H,
            -- PIX_GERADOS_TOTAIS
            (SELECT COUNT(*) AS PIXS_GERADOS_TOTAIS
                FROM transacoes
                WHERE tipo = 'deposito' 
                    AND VALOR IS NOT NULL) as PIXS_GERADOS_TOTAIS,
            -- PIX_PAGOS_TOTAIS
            (SELECT COUNT(*) AS PIXS_PAGOS_TOTAIS
                FROM transacoes
                WHERE tipo = 'deposito' 
                    AND STATUS = 'pago'
                    AND VALOR IS NOT NULL) as PIXS_PAGOS_TOTAIS,
            -- C A D A S T R O
            -- CADASTRO_24H
            (SELECT COUNT(DISTINCT usuario)
                FROM transacoes
                WHERE data_hora >= NOW() - INTERVAL 24 HOUR) as CADASTRO_24H,
            -- CADASTRO 7D
            (SELECT COUNT(DISTINCT usuario)
                FROM transacoes
                WHERE data_hora >= NOW() - INTERVAL 7 DAY  ) as CADASTRO_7D,
            -- CADASTRO 30D
            (SELECT COUNT(DISTINCT usuario)
                FROM transacoes
                WHERE data_hora >= NOW() - INTERVAL 30 DAY  ) as CADASTRO_30D,
            -- CADASTRO TOTAIS
            (SELECT COUNT(DISTINCT usuario)
                FROM transacoes
            ) as CADASTRO_TOTAIS
    ");
        return $query->row_array();
    }
    public function getSaques() {
        $this->db->select('saques.*, usuarios.nome, usuarios.cpf, usuarios.email');
        $this->db->from('saques');
        $this->db->join('usuarios', 'saques.usuario = usuarios.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getSaquesByUser($id) {
        $this->db->select('saques.*, usuarios.nome, usuarios.cpf, usuarios.email');
        $this->db->from('saques');
        $this->db->join('usuarios', 'saques.usuario = usuarios.id');
        $this->db->where('saques.usuario', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getDepByUser($id) {
        $this->db->select('t.transacao_id, t.valor, t.tipo, t.data_hora, t.qrcode, t.code, t.status, u.nome AS nome_usuario, u.nascimento, u.cpf, u.telefone, u.email, u.afiliado, u.endereco, u.cep');
        $this->db->from('transacoes t');
        $this->db->join('usuarios u', 't.usuario = u.id');
        $this->db->where('t.tipo', 'deposito');
        $this->db->where('t.usuario', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getSoliSaques() {
        $this->db->select('saques.*, usuarios.nome, usuarios.email');
        $this->db->from('saques');
        $this->db->join('usuarios', 'saques.usuario = usuarios.id');
        $this->db->where('saques.pago', 0);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function getSoliSaquesWCashback() {
        $this->db->select('saques.*, usuarios.nome, usuarios.email, tmp_cashback.valor as cashback');
        $this->db->from('saques');
        $this->db->join('usuarios', 'saques.usuario = usuarios.id');
        $this->db->join('tmp_cashback', 'saques.usuario = tmp_cashback.usuario', 'left');
        $this->db->where('saques.pago', 0);
        $query = $this->db->get();
        
        return $query->result();
    }
    public function getDep() {
        $this->db->select('t.id AS transacao_id, t.valor, t.tipo, t.data_hora, t.qrcode, t.code, t.status, u.nome AS nome_usuario, u.nascimento, u.cpf, u.telefone, u.email, u.afiliado, u.endereco, u.cep');
        $this->db->from('transacoes t');
        $this->db->join('usuarios u', 't.usuario = u.id');
        $this->db->where('t.tipo', 'deposito');
        $query = $this->db->get();
        return $query->result();
    }
    public function getMov() {
        $this->db->select('t.id AS transacao_id, t.valor, t.tipo, t.data_hora, t.qrcode, t.code, t.status, u.nome AS nome_usuario, u.nascimento, u.cpf, u.telefone, u.email, u.afiliado, u.endereco, u.cep');
        $this->db->from('transacoes t');
        $this->db->join('usuarios u', 't.usuario = u.id');
        $query = $this->db->get();
        return $query->result();
    }
    
	public function isEzzyBank() {
        $query = $this->db->get_where('ezzebank', array('id' => 0, 'ativo' => 1));
        if ($query->num_rows() > 0) {
            return true; 
        } else {
            return false; 
        }
    }

    public function checkUserExistInWallet() {
        $usuarios = $this->db->get('usuarios')->result();
        foreach ($usuarios as $usuario) {
            $this->db->where('usuario', $usuario->id);
            $result = $this->db->get('financeiro');

            if ($result->num_rows() == 0) {
                $data = array(
                    'usuario' => $usuario->id,
                    'saldo' => 0,
                    'bonus' => 0
                );
                $this->db->insert('financeiro', $data);
            }
        }
    }

    public function getUsuarioHistoricoJogo($usuario_id) {
        $this->db->select('historico.*, games.game_name');
        $this->db->from('usuarios');
        $this->db->where('usuarios.id', $usuario_id);
        $this->db->join('historico', 'usuarios.id = historico.usuario', 'inner');
        $this->db->join('games', 'historico.jogo = games.game_code', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Retorna uma única linha de resultado
        } else {
            return null; // Retorna null se não houver resultados
        }
    }

    public function configFin($codigo)
    {
        $query = $this->db->get_where('financeiro_config', array('cod' => $codigo, 'status' => 1));

        if ($query->num_rows() > 0) {

            $rest = array(
                'valor' => $query->row()->valor,
                'status' => $query->row()->status,
            );

            return $rest;
        } else {
            return false;
        }
    }

    public function checkHaveWithdrawal() {
        $query = $this->db->get_where('saques', array('status' => 'pendente', 'pago' => 0));
        $count = $query->num_rows();
        $this->session->set_userdata('saques', $count);
    }

}