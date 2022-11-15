-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/

-- Criar com o nome pucademia, usando latin1_swedish_nopad_ci
-- Rodar o sql abaixo

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE Plano (
planoId varchar(10) NOT NULL PRIMARY KEY,
nome varchar(50),
tempo varchar(50),
preco numeric(5,2),
descricao varchar(200)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Pessoa (
pessoaId int NOT NULL PRIMARY KEY AUTO_INCREMENT,
nome varchar(100)  NOT NULL,
cpfCnpj varchar(50) NOT NULL,
email varchar(50) NOT NULL,
dataNascimento date NOT NULL,
genero varchar(20),
logradouro varchar(120),
complemento varchar(100),
cep varchar(20),
bairro varchar(20),
cidade varchar(50),
estado varchar(50),
UNIQUE (cpfCnpj, email)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Aluno (
pessoaId int NOT NULL PRIMARY KEY,
peso numeric(4,1),
objetivo varchar(100),
altura numeric(3,2),
restricao varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE Aluno ADD CONSTRAINT FK_Aluno_1
    FOREIGN KEY (pessoaId)
    REFERENCES Pessoa (pessoaId);

CREATE TABLE aluno_plano (
pessoaId int,
planoId varchar(10),
dataInicio date,
vigencia bit DEFAULT 1,
PRIMARY KEY (pessoaId, planoId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE aluno_plano ADD CONSTRAINT fk_aluno_pessoaId
    FOREIGN KEY (pessoaId)
    REFERENCES Aluno (pessoaId);

ALTER TABLE aluno_plano ADD CONSTRAINT fk_planoId
    FOREIGN KEY (planoId)
    REFERENCES Plano (planoId);

INSERT INTO Pessoa (pessoaId, nome, cpfCnpj, email, dataNascimento, genero, logradouro, complemento, cep, bairro, cidade, estado) VALUES
(1, 'Aline Mattos', '12345678910', 'aline_m@email.com', '1995/12/04', 'feminino', 'Rua do Shopping, 1900', 'Apartamento 2', '80000-000', 'Mossunguê', 'Curitiba', 'Paraná'),
(2, 'Amanda Bressam', '12345678911', 'amanda_b@email.com', '2000/07/07', 'feminino', 'Rua dos Cachorrinhos, 584', 'Casa', '80000-001', 'Hauer', 'Curitiba', 'Paraná'),
(3, 'Gabriel Barros', '12345678912', 'barros@email.com', '1999/06/17', 'masculino', 'Rua do Subway, 47', 'Apartamento 502', '80000-002', 'Rebouças', 'Curitiba', 'Paraná'),
(4, 'Guilherme Marcondes', '12345678913', 'guilherme_m@email.com', '2003/12/08', 'masculino', 'Rua Sinatra, 98', 'Casa', '80000-003', 'Água Verde', 'Curitiba', 'Paraná'),
(5, 'Matheus Romeike', '12345678914', 'matheus_r@email.com', '2003/04/04', 'masculino', 'Rua dos Gatos Brancos, 123', 'Casa', '80000-004', 'Água Verde', 'Curitiba', 'Paraná'),
(6, 'Maiza Vitoria', '12345678915', 'maiza_v@email.com', '2004/08/05', 'masculino', 'Rua do Cinema, 264', 'Casa', '80000-005', 'Água Verde', 'Curitiba', 'Paraná'),
(7, 'Eduardo Rufino', '12345678916', 'maiza_v@email.com', '2004/08/05', 'masculino', 'Rua da Praia, 987', 'Apartamento 63', '80000-006', 'Água Verde', 'Curitiba', 'Paraná'),
(8, 'Daniel Oliveira', '12345678917', 'daniel_o@email.com', '1997/01/21', 'masculino', 'Rua do Shopping, 1900', 'Apartamento 2', '80000-000', 'Mossunguê', 'Curitiba', 'Paraná'),
(9, 'Felipe Alloy', '12345678918', 'felipe_a@email.com', '1986/01/20', 'masculino', 'Rua das Rosas, 444', 'Casa', '80000-007', 'Batel', 'Curitiba', 'Paraná'),
(10, 'Fernanda Souza', '12345678919', 'fernanda_s@email.com', '1986/03/22', 'feminino', 'Rua dos Gatos Brancos, 125', 'Casa', '80000-004', 'Água Verde', 'Curitiba', 'Paraná'),
(11, 'Juliana Motta', '12345678920', 'juli_m@email.com', '1995/05/18', 'feminino', 'Rua dos Gatos Pretos, 777', 'Casa', '80000-008', 'Água Verde', 'Curitiba', 'Paraná'),
(12, 'João Pereira', '12345678921', 'joao_p@email.com', '1996/06/25', 'masculino', 'Rua das Violetas, 222', 'Apartamento 201', '80000-009', 'Batel', 'Curitiba', 'Paraná'),
(13, 'Rui Souza', '12345678922', 'ruivo@email.com', '1968/11/14', 'masculino', 'Rua das Andorinhas, 2057', 'Casa', '80000-010', 'Xaxim', 'Curitiba', 'Paraná'),
(14, 'Beatriz Fernandes', '12345678923', 'bia_f@email.com', '1995/10/08', 'feminino', 'Rua Papagaio, 305', 'Apartamento 103', '80000-011', 'Bacacheri', 'Curitiba', 'Paraná'),
(15, 'Bruna Fernandes', '12345678924', 'bru_f@email.com', '1999/05/04', 'feminino', 'Rua Papagaio, 305', 'Apartamento 103', '80000-011', 'Bacacheri', 'Curitiba', 'Paraná'),
(16, 'Rosa Fernandes', '12345678925', 'rosinha_fernandes@email.com', '1965/12/10', 'feminino', 'Rua Papagaio, 305', 'Apartamento 103', '80000-011', 'Bacacheri', 'Curitiba', 'Paraná'),
(17, 'João Fernandes', '12345678926', 'joaozinho_fernandes@email.com', '1966/01/16', 'masculino', 'Rua Papagaio, 305', 'Apartamento 103', '80000-011', 'Bacacheri', 'Curitiba', 'Paraná'),
(18, 'Victória Pires', '12345678927', 'vic_pi@email.com', '1977/07/09', 'feminino', 'Rua da Felicidade, 85', 'Casa', '80000-0012', 'Santa Felicidade', 'Curitiba', 'Paraná'),
(19, 'Roberto Portugal', '12345678928', 'betto_pt@email.com', '1975/03/11', 'masculino', 'Rua da Felicidade, 85', 'Casa', '80000-0012', 'Santa Felicidade', 'Curitiba', 'Paraná'),
(20, 'Clarice Madeira', '12345678929', 'cla_mad@email.com', '1998/02/12', 'feminino', 'Rua da Risada, 16', 'Casa', '80000-013', 'Portão', 'Curitiba', 'Paraná');

INSERT INTO Aluno (pessoaId, peso, objetivo, altura, restricao) VALUES
(1, 83.2, 'emagrecimento', 1.60, 'nenhuma'),
(2, 59.3,'fortalecimento', 1.65, 'pressão baixa'),
(3, 215.3,'emagrecimento', 1.69, 'obesidade mórbita'),
(4, 59.4,'hipertrofia', 1.60, 'cuidar joelhos'),
(5, 59.5,'fortalecimento', 1.75, 'nenhuma'),
(6, 59.7,'fortalecimento', 1.55, 'pressão baixa'),
(7, 59.6,'fortalecimento', 1.65, 'pressão baixa'),
(10, 59.8,'fortalecimento', 1.65, 'pressão baixa'),
(12, 59.9,'fortalecimento', 1.65, 'pressão baixa'),
(13, 51.3,'fortalecimento', 1.65, 'pressão baixa'),
(20, 53.3,'fortalecimento', 1.65, 'pressão baixa'),
(8, 89.0, 'emagrecimento, hipertrofia', 1.65, 'cirurgia pino pulso esquerdo'), 
(9, 105.7, 'emagrecimento', 1.78, 'cuidar joelhos'),
(11, 98.7, 'emagrecimento', 1.65, 'pressão alta'),
(14, 62.0, 'emagrecimento, hipertrofia', 1.62, 'nenhuma'),
(15, 56.2,  'hipertrofia', 1.75, 'nenhuma'),
(16, 86.4, 'emagrecimento, fortalecer coluna', 1.65, 'cuidar coluna'),
(17, 94.0, 'emagrecimento, hipertrofia', 1.80, 'cuidar ombros'),
(18, 52.5, 'fortalecimento', 1.65, 'pressão baixa'),
(19, 88.8, 'emagrecimento, hipertrofia', 1.86, 'nenhuma');

INSERT INTO Plano (planoId, nome, tempo, preco, descricao) VALUES
('PR12', 'Premium 12', 12, 199.90, 'Plano individual com acesso ilimitado às áreas da academia por 12 meses, sem fidelidade'),
('PR06', 'Premium 6', 6, 149.90, 'Plano individual com acesso ilimitado às áreas da academia por 6 meses, sem fidelidade'),
('PR03', 'Premium 3', 3, 129.90, 'Plano individual com acesso ilimitado às áreas da academia por 3 meses, sem fidelidade'),
('PR01', 'Premium 1', 1, 89.90, 'Plano individual com acesso ilimitado às áreas da academia por 1 mês, sem fidelidade'),
('FAM12', 'Família 12 meses', 12, 699.90, 'Plano família, até 4 pessoas, com acesso ilimitado às áreas da academia por 6 meses, sem fidelidade'),
('FAM6', 'Família 6 meses', 6, 499.90, 'Plano família, até 4 pessoas, com acesso ilimitado às áreas da academia por 6 meses, sem fidelidade'),
('FAM3', 'Família 3 meses', 3, 299.90, 'Plano família, até pessoas, com acesso ilimitado às áreas da academia por 3 meses, sem fidelidade'),
('FAM1', 'Família 1 mês',1, 199.90, 'Plano família, até 4 pessoas, com acesso ilimitado às áreas da academia por 1 mês, sem fidelidade'),
('VIP12', 'Vip 12 meses', 12, 199.90, 'Plano individual com acesso ilimitado às áreas da academia por 12 meses, sala de massagem, trazer amigos, com fidelidade'),
('VIP6', 'Vip 6 meses', 6, 149.90, 'Plano individual com acesso ilimitado às áreas da academia por 6 meses, sala de massagem, trazer amigos, com fidelidade'),
('VIP3', 'Vip 3 meses', 3, 129.90, 'Plano individual com acesso ilimitado às áreas da academia por 3 meses, sala de massagem, trazer amigos, com fidelidade');

INSERT INTO aluno_plano (pessoaId, planoId, dataInicio, vigencia) VALUES
(1,'PR12', '2022/01/01', 1),
(2,'PR12', '2022/01/01', 1),
(3,'PR12', '2022/01/01', 1),
(4,'PR12', '2022/01/01', 1),
(5,'VIP12', '2022/05/12', 1),
(6,'VIP12', '2022/05/12', 1),
(7,'VIP12', '2022/05/12', 1),
(10,'FAM12', '2022/07/01', 1),
(12,'FAM12', '2022/07/01', 1),
(13,'FAM12', '2022/07/01', 1),
(20,'FAM12', '2022/07/01', 1),
(8, 'PR12', '2022/01/01', 1),
(9, 'PR03', '2022/09/02', 1),
(11, 'VIP12', '2022/05/12', 1),
(14, 'FAM6', '2022/05/12', 1),
(15, 'FAM6', '2022/05/12', 1),
(16, 'FAM6', '2022/05/12', 1),
(17, 'FAM6', '2022/05/12', 1),
(18, 'FAM12', '2022/07/01', 1),
(19, 'FAM12', '2022/07/01', 1);