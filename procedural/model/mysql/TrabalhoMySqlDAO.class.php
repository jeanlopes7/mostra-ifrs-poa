<?php

/**
 * Classe de operação da tabela 'trabalho'. Banco de Dados Mysql.
 * Estas classes não contemplam meu projeto final, por estarem obsoletas, estou contruindo
 * novos templates em Persistent Data Object com definição de prepared statements contra
 * sql injection, utilize para meio de testes, nunca coloque em produção, servindo
 * apenas de trampolin para classe de produção
 *
 * @autor: Alessander Wasem
 * @data: 2014-05-21 21:57
 */
class TrabalhoMySqlDAO {

    protected $table = 'trabalho';

    /**
     * Implementa o dominio chave primária na seleção de único registro
     *
     * @parametro String $id primary key
     * @retorna TrabalhoMySql 
     */
    public function load($id) {
        $sql = "SELECT * FROM $this->table WHERE id_trabalho = :id_trabalho";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_trabalho', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function load2($id) {
        $sql = "SELECT t.*, "
                . "c.id_curso, c.nome as nome_curso, "
                . "a.id_area, a.nome as nome_area, "
                . "cat.id_categoria, cat.nome as nome_categoria, "
                . "m.id_modalidade, m.nome as nome_modalidade, "
                . "tac.seq as seq_trabalho "
                . "FROM trabalho t "
                . "INNER JOIN trabalho_autor_curso tac ON t.id_trabalho = tac.fk_trabalho "
                . "INNER JOIN curso c ON c.id_curso = tac.fk_curso "
                . "INNER JOIN area a ON a.id_area = t.fk_area "
                . "INNER JOIN categoria cat ON cat.id_categoria = t.fk_categoria "
                . "INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade "
                . "WHERE t.id_trabalho = :id_trabalho AND tac.seq = 1";

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_trabalho', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function loadAutorPrincipal($id_trabalho) {
        $autores = $this->queryAllAutoresCursosOrderBySeq($id_trabalho);
        return $autores[0];
    }

    public function loadOrientadorPrincipal($id_trabalho) {
        $orientadores = $this->queryAllOrientadoresCampusOrderBySeq($id_trabalho);
        return $orientadores[0];
    }

    /**
     * Obtem todos o registros das Tabelas
     */
    public function queryAll() {
        $sql = "SELECT * FROM $this->table";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* Alexdg 2015
     * Obtem todos os trabalhos que o autor participa.
     */
    public function queryTrabalhosByAutor($id_autor) {
        $sql = "SELECT t.*, "
                . "c.id_curso, c.nome as nome_curso, "
                . "a.id_area, a.nome as nome_area, "
                . "cat.id_categoria, cat.nome as nome_categoria, "
                . "m.id_modalidade, m.nome as nome_modalidade, "
                . "tac.seq as seq_trabalho "
                . "FROM trabalho t "
                . "INNER JOIN trabalho_autor_curso tac ON t.id_trabalho = tac.fk_trabalho "
                . "INNER JOIN curso c ON c.id_curso = tac.fk_curso "
                . "INNER JOIN area a ON a.id_area = t.fk_area "
                . "INNER JOIN categoria cat ON cat.id_categoria = t.fk_categoria "
                . "INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade "
                . "WHERE tac.fk_autor = :fk_autor order by t.id_trabalho ";

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_autor', $id_autor);
        $stmt->execute();
        return $stmt->fetchAll();
    }//queryTrabalhosByAutor()

    /* Alexdg 2015
     * Obtem todos os trabalhos em que o autor participa como primeiro autor.
     */
    public function queryTrabalhosByAutorPrincipal($id_autor) {
        $sql = "SELECT t.*, "
                . "c.id_curso, c.nome as nome_curso, "
                . "a.id_area, a.nome as nome_area, "
                . "cat.id_categoria, cat.nome as nome_categoria, "
                . "m.id_modalidade, m.nome as nome_modalidade, "
                . "tac.seq as seq_trabalho "
                . "FROM trabalho t "
                . "INNER JOIN trabalho_autor_curso tac ON t.id_trabalho = tac.fk_trabalho "
                . "INNER JOIN curso c ON c.id_curso = tac.fk_curso "
                . "INNER JOIN area a ON a.id_area = t.fk_area "
                . "INNER JOIN categoria cat ON cat.id_categoria = t.fk_categoria "
                . "INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade "
                . "WHERE tac.fk_autor = :fk_autor AND tac.seq = 1 order by t.id_trabalho ";

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_autor', $id_autor);
        $stmt->execute();
        return $stmt->fetchAll();
    }//queryTrabalhosByAutorPrincipal()

    /* Alexdg 2015
     * Obtem todos os trabalhos que o orientador participa.
     */
    public function queryTrabalhosByOrientador($id_orientador) {
        $sql = "SELECT t.*, "
                . "cam.id_campus, cam.nome as nome_campus, "
                . "a.id_area, a.nome as nome_area, "
                . "cat.id_categoria, cat.nome as nome_categoria, "
                . "m.id_modalidade, m.nome as nome_modalidade, "
                . "toc.seq as seq_trabalho "
                . "FROM trabalho t "
                . "INNER JOIN trabalho_orientador_campus toc ON t.id_trabalho = toc.fk_trabalho "
                . "INNER JOIN campus cam ON cam.id_campus = toc.fk_campus "
                . "INNER JOIN area a ON a.id_area = t.fk_area "
                . "INNER JOIN categoria cat ON cat.id_categoria = t.fk_categoria "
                . "INNER JOIN modalidade m ON m.id_modalidade = t.fk_modalidade "
                . "WHERE toc.fk_orientador = :fk_orientador order by t.id_trabalho ";

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_orientador', $id_orientador);
        $stmt->execute();
        return $stmt->fetchAll();
    }//queryTrabalhosByOrientador()

    public function queryAllAutoresCursosOrderBySeq($id_trabalho) {
        $sql = "SELECT tac.fk_trabalho, tac.fk_autor, tac.fk_curso, tac.seq, tac.email_trabalho, "
                . "c.nome as nome_curso, ca.nome as nome_campus, i.sigla, u.id_usuario, u.nome as nome_usuario "
                . "FROM trabalho_autor_curso tac "
                . "INNER JOIN autor_curso ac ON ac.fk_autor = tac.fk_autor AND ac.fk_curso = tac.fk_curso "
                . "INNER JOIN curso c ON c.id_curso = ac.fk_curso "
                . "INNER JOIN campus ca ON ca.id_campus = c.fk_campus "
                . "INNER JOIN instituicao i ON i.id_instituicao = ca.fk_instituicao "
                . "INNER JOIN autor au ON au.fk_usuario = ac.fk_autor "
                . "INNER JOIN usuario u ON u.id_usuario = au.fk_usuario "
                . "WHERE tac.fk_trabalho = :fk_trabalho ORDER BY tac.seq";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_trabalho', $id_trabalho);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function queryQuantAutores($id_trabalho) {
        $sql = "SELECT count(fk_trabalho) as quant FROM trabalho_autor_curso WHERE fk_trabalho = $id_trabalho ";
        $stmt = ConnectionFactory::prepare($sql);
        //$stmt->bindParam(':fk_trabalho', $id_trabalho);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function queryQuantOrientadores($id_trabalho) {
        $sql = "SELECT count(fk_trabalho) as quant FROM trabalho_orientador_campus WHERE fk_trabalho = $id_trabalho ";
        $stmt = ConnectionFactory::prepare($sql);
        //$stmt->bindParam(':fk_trabalho', $id_trabalho);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function queryAllOrientadoresCampusOrderBySeq($id_trabalho) {
        $sql = "SELECT toc.fk_trabalho, toc.fk_orientador, toc.fk_campus, toc.seq, toc.email_trabalho, "
                . "cam.nome as nome_campus, i.sigla, u.id_usuario, u.nome as nome_usuario "
                . "FROM trabalho_orientador_campus toc "
                . "INNER JOIN orientador_campus oc ON oc.fk_orientador = toc.fk_orientador AND oc.fk_campus = toc.fk_campus "
                . "INNER JOIN campus cam ON cam.id_campus = oc.fk_campus "
                . "INNER JOIN instituicao i ON i.id_instituicao = cam.fk_instituicao "
                . "INNER JOIN orientador o ON o.fk_usuario = oc.fk_orientador "
                . "INNER JOIN usuario u ON u.id_usuario = o.fk_usuario "
                . "WHERE toc.fk_trabalho = :fk_trabalho ORDER BY toc.seq";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':fk_trabalho', $id_trabalho);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function queryAllTrabalhosDeAutoresEOrientadoresByStatus($status_int) {
        $sql = "select user_autor.id_usuario as user_autor_id, "
                . "user_autor.nome as user_autor_nome, "
                . "user_autor.email as user_autor_email,"
                
                . "user_orientador.id_usuario as user_orientador_id, "
                . "user_orientador.nome as user_orientador_nome, "
                . "user_orientador.email as user_orientador_email,"
                . "trabalho.status from trabalho "
               ."left join trabalho_autor_curso on trabalho.id_trabalho = trabalho_autor_curso.fk_trabalho "
               ."left join usuario as user_autor on trabalho_autor_curso.fk_autor = user_autor.id_usuario "
               ."left join trabalho_orientador_campus on trabalho.id_trabalho = trabalho_orientador_campus.fk_trabalho "
               ."left join usuario as user_orientador on trabalho_orientador_campus.fk_orientador = user_orientador.id_usuario "
               ."where trabalho.status = :status";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':status', $status_int);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function queryAllTrabalhosFormatoCertificado() {
        $sql = <<<SQL
                select 
                t.id_trabalho,
                u.nome,
                u.email, 
                concat('\'', lpad(u.cpf, 11, '0')) as cpf,
                replace(replace(t.titulo_ordenar, '<p>', ''), '</p>', '') as titulo, 

                (select replace(group_concat(a.nome), ',', ', ') from autor
                inner join usuario as a on autor.fk_usuario = a.id_usuario 
                inner join trabalho_autor_curso tac on autor.fk_usuario = tac.fk_autor
                where tac.fk_trabalho = t.id_trabalho order by tac.seq) as autor_trabalho,

                (select replace(group_concat(a.nome), ',', ', ') from  orientador
                inner join usuario as a on orientador.fk_usuario = a.id_usuario
                inner join trabalho_orientador_campus as toc on orientador.fk_usuario = toc.fk_orientador
                where toc.fk_trabalho = t.id_trabalho order by toc.seq) as orientador_trabalho

                from trabalho t

                inner join trabalho_autor_curso on t.id_trabalho = trabalho_autor_curso.fk_trabalho
                inner join usuario as u on trabalho_autor_curso.fk_autor = u.id_usuario
				
				UNION

                select 
t2.id_trabalho,
                u2.nome,
                u2.email, 
                concat('\'', lpad(u2.cpf, 11, '0')) as cpf,
                replace(replace(t2.titulo_ordenar, '<p>', ''), '</p>', '') as titulo, 

                (select replace(group_concat(a2.nome), ',', ', ') from autor
                inner join usuario as a2 on autor.fk_usuario = a2.id_usuario 
                inner join trabalho_autor_curso tac2 on autor.fk_usuario = tac2.fk_autor
                where tac2.fk_trabalho = t2.id_trabalho order by tac2.seq) as autor_trabalho,

                (select replace(group_concat(a2.nome), ',', ', ') from  orientador
                inner join usuario as a2 on orientador.fk_usuario = a2.id_usuario
                inner join trabalho_orientador_campus as toc2 on orientador.fk_usuario = toc2.fk_orientador
                where toc2.fk_trabalho = t2.id_trabalho order by toc2.seq) as orientador_trabalho

                from trabalho t2

                inner join trabalho_orientador_campus on t2.id_trabalho = trabalho_orientador_campus.fk_trabalho
                inner join usuario as u2 on trabalho_orientador_campus.fk_orientador = u2.id_usuario

order by id_trabalho
				
SQL;
        $stmt = ConnectionFactory::prepare($sql); $stmt->execute();
        return $stmt->fetchAll();
    }
    
    
    public function enviarEmailParaAutoresEOrientadoresByTrabalhoStatus($status_int) {
        
        $res = $this->queryAllTrabalhosDeAutoresEOrientadoresByStatus($status_int);
        
        $lista_emails = array();
        foreach ($res as $obj) {
            if ($obj->user_autor_email != null)
                $lista_emails[] = $obj->user_autor_email;
            if ($obj->user_orientador_email != null)
                $lista_emails[] = $obj->user_orientador_email;
        }
        //var_dump($GLOBALS); die;
        if ($status_int == 0) {
            foreach ($lista_emails as $mail) {
                mail($mail, $GLOBALS['email']['pendentes']['assunto'], $GLOBALS['email']['pendentes']['corpo']);
            }
            
        }
        if ($status_int == 1) {
            foreach ($lista_emails as $mail) {
                mail($mail, $GLOBALS['email']['enviados']['assunto'], $GLOBALS['email']['enviados']['corpo']);
            }
            
        }
    }  

    /**
     * Exclui um registro da tabela
     * @parametro trabalho chave primária
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id_trabalho = :id_trabalho";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_trabalho', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Inseri um registro na tabela
     *
     * @parametro TrabalhoMySql trabalho
     */
    public function insert(\Entity\Trabalho $Trabalho) {
        //Nao preenche os campos data_atualizacao e ip_atualizacao.
        //Preenche o campo data_cadastro automaticamente com a data atual do servidor de banco de dados.
        $sql = "INSERT INTO $this->table (fk_area, fk_categoria, fk_modalidade, nivel, titulo, titulo_ordenar, palavra1, palavra2, palavra3, apoiadores, resumo, resumo2, status, data_cadastro, ip_cadastro, fk_sessao, seq_sessao, nota, premiado, turno1, turno2, turno3) VALUES ( :fkArea,  :fkCategoria,  :fkModalidade,  :nivel,  :titulo,  :tituloOrdenar,  :palavra1,  :palavra2,  :palavra3,  :apoiadores,  :resumo,  :resumo2,  :status,  sysdate(),  :ipCadastro,  :fkSessao,  :seqSessao,  :nota,  :premiado, :turno1, :turno2, :turno3)";

        $fkArea = $Trabalho->getFkArea();
        $fkCategoria = $Trabalho->getFkCategoria();
        $fkModalidade = $Trabalho->getFkModalidade();
        $nivel = $Trabalho->getNivel();
        $titulo = $Trabalho->getTitulo();
        $tituloOrdenar = $Trabalho->getTituloOrdenar();
        $palavra1 = $Trabalho->getPalavra1();
        $palavra2 = $Trabalho->getPalavra2();
        $palavra3 = $Trabalho->getPalavra3();
        $apoiadores = $Trabalho->getApoiadores();
        $resumo = $Trabalho->getResumo();
        $resumo2 = $Trabalho->getResumo2();
        $status = $Trabalho->getStatus();
        $ipCadastro = $Trabalho->getIpCadastro();
        $fkSessao = $Trabalho->getFkSessao();
        $seqSessao = $Trabalho->getSeqSessao();
        $nota = $Trabalho->getNota();
        $premiado = $Trabalho->getPremiado();
        $turno1 = $Trabalho->getTurno1();
        $turno2 = $Trabalho->getTurno2();
        $turno3 = $Trabalho->getTurno3();

        $stmt = ConnectionFactory::prepare($sql);

        $stmt->bindParam(':fkArea', $fkArea);
        $stmt->bindParam(':fkCategoria', $fkCategoria);
        $stmt->bindParam(':fkModalidade', $fkModalidade);
        $stmt->bindParam(':nivel', $nivel);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':tituloOrdenar', $tituloOrdenar);
        $stmt->bindParam(':palavra1', $palavra1);
        $stmt->bindParam(':palavra2', $palavra2);
        $stmt->bindParam(':palavra3', $palavra3);
        $stmt->bindParam(':apoiadores', $apoiadores);
        $stmt->bindParam(':resumo', $resumo);
        $stmt->bindParam(':resumo2', $resumo2);
        $stmt->bindParam(':status', $status);
        //$stmt->bindParam(':dataCadastro', $dataCadastro);
        //$stmt->bindParam(':dataAtualizacao', $dataAtualizacao);
        $stmt->bindParam(':ipCadastro', $ipCadastro);
        //$stmt->bindParam(':ipAtualizacao', $ipAtualizacao);
        $stmt->bindParam(':fkSessao', $fkSessao);
        $stmt->bindParam(':seqSessao', $seqSessao);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':premiado', $premiado);
        $stmt->bindParam(':turno1', $turno1);
        $stmt->bindParam(':turno2', $turno2);
        $stmt->bindParam(':turno3', $turno3);
        
        $stmt->execute();

        $sql = "SELECT LAST_INSERT_ID() as last_id";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->execute();
        $last_id = (array) $stmt->fetch();
        //Pega o id_trabalho que foi gerado no banco e atualiza o objeto Trabalho.
        $id_trabalho = 0;
        foreach ($last_id as $value) {
          $id_trabalho = $value;
        }
        $Trabalho->setIdTrabalho($id_trabalho);
        return $id_tabalho;
    }

    /**
     * atualiza um registro da tabela
     *
     * @parametro TrabalhoMySql trabalho
     */
    public function update(Trabalho $Trabalho) {
        $sql = "UPDATE $this->table SET "
                . "fk_area = :fk_area, "
                . "fk_categoria = :fk_categoria, "
                . "fk_modalidade = :fk_modalidade, "
                . "nivel = :nivel, "
                . "titulo = :titulo, "
                . "titulo_ordenar = :titulo_ordenar, "
                . "palavra1 = :palavra1, "
                . "palavra2 = :palavra2, "
                . "palavra3 = :palavra3, "
                . "apoiadores = :apoiadores, "
                . "resumo = :resumo, "
                . "resumo2 = :resumo2, "
                . "status = :status, "
                . "data_atualizacao = sysdate(), "
                //. "ip_cadastro = :ip_cadastro, "
                . "ip_atualizacao = :ip_atualizacao, "
                . "fk_sessao = :fk_sessao, "
                . "seq_sessao = :seq_sessao, "
                . "nota = :nota, "
                . "premiado = :premiado, "
                . "turno1 = :turno1, "
                . "turno2 = :turno2, "
                . "turno3 = :turno3 "
                . "WHERE id_trabalho = :id";
        $id = (int) ($Trabalho->getIdTrabalho());


        $fkArea = $Trabalho->getFkArea();
        $fkCategoria = $Trabalho->getFkCategoria();
        $fkModalidade = $Trabalho->getFkModalidade();
        $nivel = $Trabalho->getNivel();
        $titulo = $Trabalho->getTitulo();
        $tituloOrdenar = $Trabalho->getTituloOrdenar();
        $palavra1 = $Trabalho->getPalavra1();
        $palavra2 = $Trabalho->getPalavra2();
        $palavra3 = $Trabalho->getPalavra3();
        $apoiadores = $Trabalho->getApoiadores();
        $resumo = $Trabalho->getResumo();
        $resumo2 = $Trabalho->getResumo2();
        $status = $Trabalho->getStatus();
        $dataCadastro = $Trabalho->getDataCadastro();
        $dataAtualizacao = $Trabalho->getDataAtualizacao();
        $ipCadastro = $Trabalho->getIpCadastro();
        $ipAtualizacao = $Trabalho->getIpAtualizacao();
        // $fkSessao = $Trabalho->getFkSessao();
        $seqSessao = $Trabalho->getSeqSessao();
        $nota = $Trabalho->getNota();
        $premiado = $Trabalho->getPremiado();
        $turno1 = $Trabalho->getTurno1();
        $turno2 = $Trabalho->getTurno2();
        $turno3 = $Trabalho->getTurno3();

        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':fk_area', $fkArea);
        $stmt->bindParam(':fk_categoria', $fkCategoria);
        $stmt->bindParam(':fk_modalidade', $fkModalidade);
        $stmt->bindParam(':nivel', $nivel, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':titulo_ordenar', $tituloOrdenar);
        $stmt->bindParam(':palavra1', $palavra1);
        $stmt->bindParam(':palavra2', $palavra2);
        $stmt->bindParam(':palavra3', $palavra3);
        $stmt->bindParam(':apoiadores', $apoiadores);
        $stmt->bindParam(':resumo', $resumo);
        $stmt->bindParam(':resumo2', $resumo2);
        $stmt->bindParam(':status', $status);
        //$stmt->bindParam(':dataCadastro', $dataCadastro);
        //$stmt->bindParam(':dataAtualizacao', $dataAtualizacao);
        //$stmt->bindParam(':ipCadastro', $ipCadastro);
        $stmt->bindParam(':ip_atualizacao', $ipAtualizacao);
        $stmt->bindParam(':fk_sessao', $fkSessao, PDO::PARAM_INT);
        $stmt->bindParam(':seq_sessao', $seqSessao, PDO::PARAM_INT);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':premiado', $premiado);
        $stmt->bindParam(':turno1', $turno1);
        $stmt->bindParam(':turno2', $turno2);
        $stmt->bindParam(':turno3', $turno3);

        //var_dump($trabalho);

        return $stmt->execute();
    }

    public function changeStatus($id_trabalho, $status) {
        $sql = "UPDATE $this->table SET status = :status WHERE id_trabalho = :id_trabalho";
        $stmt = ConnectionFactory::prepare($sql);
        $stmt->bindParam(':id_trabalho', $id_trabalho, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        return $stmt->execute();
    }

   
}

//TrabalhoMysqlDAO
