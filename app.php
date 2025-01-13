<?php

    class Convidado {
        public $nome;
        public $telefone;
        public $email;
        public $presenca;

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
            return $this;
        }
    }

    class Conexao {
        private $host = 'localhost';
        private $dbname = 'presenca';
        private $user = 'root';
        private $pass = '';

        public function conectar(){
            try {

                $conexao = new PDO(
                    "mysql: host=$this->host;dbname=$this->dbname",
                    "$this->user",
                    "$this->pass"
                );

                $conexao->exec('set charset utf8');
                return $conexao;

            } catch (PDOExeption $e) {
                echo '<p>' . $e->getMessege() . '</p>';
            }
        }
    }

    class Bd {
        private $conexao;
        private $convidado;

        public function __construct(Conexao $conexao, Convidado $convidado){
            $this->conexao = $conexao->conectar();
            $this->convidado = $convidado;
        }

        public function getConvidados(){
            $query = 'select 
                        :nome 
                    from 
                        tb_convidados 
                    where 
                        data_venda between :data_inicio and :data_fim';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':nome', $this->convidado->__get('nome'));
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_OBJ)->convidados;
        }

        public function getRespostas(){
            $query = 'select 
                        :confirmacao 
                    from 
                        tb_vendas';

            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':confirmacao', $this->dashboard->__get('confirmacao'));
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_OBJ)->respostas;
        }
    }

    $convidado = new Convidado();
    $conexao = new Conexao();

    /*
    $competencia = explode('-', $_GET['competencia']);
    $ano = $competencia[0];
    $mes = $competencia[1];

    $dias_do_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
    

    $dashboard->__set('data_inicio', $ano . '-' . $mes . '-01');
    $dashboard->__set('data_fim', $ano . '-' . $mes . '-' . $dias_do_mes);
    */

    $bd = new Bd($conexao, $convidado);
    
    $convidado->__set('confirmacao', $bd ->getRespostas());
    echo json_encode($convidado);


?>