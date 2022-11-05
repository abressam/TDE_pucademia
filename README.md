# TDE_pucademia
localhost/phpmyadmin
-Criar com o nome pucademia, usando latin1_swedish_nopad_ci
-Rodar o sql abaixo

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
pessoaId int NOT NULL PRIMARY KEY,
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
matricula varchar(20) NOT NULL UNIQUE,
peso numeric(4,1),
objetivo varchar(100),
altura numeric(3,2),
restricao varchar(100)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE Aluno ADD CONSTRAINT FK_Aluno_1
    FOREIGN KEY (pessoaId)
    REFERENCES Pessoa (pessoaId);
    
CREATE TABLE Professor (
    pessoaId int NOT NULL PRIMARY KEY,
    jornadaTrabalho varchar(20) NOT NULL,
    salario numeric(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE Professor ADD CONSTRAINT FK_Professor_2
    FOREIGN KEY (pessoaId)
    REFERENCES Pessoa (pessoaId);

CREATE TABLE telefone (
    pessoaId int,
    telefone varchar(50),
    PRIMARY KEY (telefone, pessoaId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE telefone ADD CONSTRAINT FK_telefone_1
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

INSERT INTO Aluno (pessoaId, matricula, peso, objetivo, altura, restricao) VALUES
(1, '0001', 83.2, 'emagrecimento', 1.60, 'nenhuma'),
(8, '0002', 89.0, 'emagrecimento, hipertrofia', 1.65, 'cirurgia pino pulso esquerdo'), 
(9, '0003', 105.7, 'emagrecimento', 1.78, 'cuidar joelhos'),
(11, '0004', 98.7, 'emagrecimento', 1.65, 'pressão alta'),
(14, '0005', 62.0, 'emagrecimento, hipertrofia', 1.62, 'nenhuma'),
(15, '0006', 56.2,  'hipertrofia', 1.75, 'nenhuma'),
(16, '0007', 86.4, 'emagrecimento, fortalecer coluna', 1.65, 'cuidar coluna'),
(17, '0008', 94.0, 'emagrecimento, hipertrofia', 1.80, 'cuidar ombros'),
(18, '0009', 52.5, 'fortalecimento', 1.65, 'pressão baixa'),
(19, '0010', 88.8, 'emagrecimento, hipertrofia', 1.86, 'nenhuma');

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
(8, 'PR12', '2022/01/01', 1),
(9, 'PR03', '2022/09/02', 1),
(11, 'VIP12', '2022/05/12', 1),
(14, 'FAM6', '2022/05/12', 1),
(15, 'FAM6', '2022/05/12', 1),
(16, 'FAM6', '2022/05/12', 1),
(17, 'FAM6', '2022/05/12', 1),
(18, 'FAM12', '2022/07/01', 1),
(19, 'FAM12', '2022/07/01', 1);

INSERT INTO telefone (pessoaId, telefone) VALUES
(1, '41-999999991'),
(2, '41-999999992'),
(3, '41-999999993'),
(4, '41-999999994'),
(5, '41-999999995'),
(6, '41-999999996'),
(7, '41-999999997'),
(8, '41-999999998'),
(9, '41-999999999'),
(10, '41-999999990'),
(11, '41-989999991'),
(12, '41-989999992'),
(13, '41-989999993'),
(14, '41-989999994'),
(14, '41-32323232'),
(15, '41-989999995'),
(15, '41-32323232'),
(16, '41-989999996'),
(16, '41-32323232'),
(17, '41-989999997'),
(17, '41-32323232'),
(18, '41-989999998'),
(19, '41-989999999'),
(20, '41-989999990');

INSERT INTO Professor (pessoaId, jornadaTrabalho, salario) VALUES
(2, 'manhã', 3500.00),
(3, 'tarde', 2000.00),
(4, 'noite', 2500.00),
(5, 'manhã', 3500.00),
(6, 'tarde', 2000.00),
(7, 'noite', 2500.00),
(10, 'manhã', 3500.00),
(12, 'tarde', 2000.00),
(13, 'noite', 4500.00),
(20, 'manhã', 3500.00);