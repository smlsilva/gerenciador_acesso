<?php
    class Conexao
    {    
        private $server = '127.0.0.1';
        private $usuario = 'root';
        private $senha = '';
        private $banco = 'suportes_suportespi';

        public function conn()
        {
            try{
                $conn = new PDO("mysql:host=$this->server;dbname=$this->banco", $this->usuario, $this->senha);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->exec('SET CHARACTER SET utf8');   
                return $conn;
            }
            catch(Exception $e)
            {
                exit($e->getMessage());
            }
        }

    }
?>