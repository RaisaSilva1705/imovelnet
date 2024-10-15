INSERT INTO lojas (nome_loja, cnpj, creci, link) VALUES
('Loja ABC', '12.345.678/0001-90', 'CRECI-SP 123456', 'http://www.lojabc.com.br'),
('Loja XYZ', '98.765.432/0001-01', 'CRECI-RJ 654321', 'http://www.lojaxyz.com.br'),
('Supermercado Central', '23.456.789/0001-23', 'CRECI-MG 789012', 'http://www.supercentral.com.br'),
('Eletrônicos e Cia', '34.567.890/0001-34', 'CRECI-PR 345678', 'http://www.eletronicoscia.com.br'),
('Livraria Mundo Livre', '45.678.901/0001-45', 'CRECI-BA 456789', 'http://www.mundolivre.com.br'),
('Roupas e Estilo', '56.789.012/0001-56', 'CRECI-PE 567890', 'http://www.roupaseestilo.com.br'),
('Farmácia Saúde', '67.890.123/0001-67', 'CRECI-CE 678901', 'http://www.farmaciasaude.com.br'),
('Móveis e Decoração', '78.901.234/0001-78', 'CRECI-SC 789012', 'http://www.moveisdecoracao.com.br'),
('Automóveis e Cia', '89.012.345/0001-89', 'CRECI-RS 890123', 'http://www.automoveiscia.com.br'),
('Pet Shop Amigo Fiel', '90.123.456/0001-90', 'CRECI-DF 901234', 'http://www.petshopamigofiel.com.br');

INSERT INTO clientes (
    id_loja, nome_completo, tipo_pessoa, documento, tipo_cliente, email, telefone, cep, endereco, endereco_numero, complemento, bairro, cidade, estado, obs, status, dt_reg, dt_alt
) VALUES
(1, 'João da Silva', 'PF', '123.456.789-00', 'COMPRADOR', 'joao.silva@email.com', '11987654321', '01000-000', 'Rua A', '123', 'Apto 45', 'Centro', 'São Paulo', 'SP', 'Cliente ativo', '1', NOW(), NOW()),
(1, 'Maria Oliveira', 'PF', '234.567.890-11', 'VENDEDOR', 'maria.oliveira@email.com', '11976543210', '02000-000', 'Rua B', '456', 'Sala 2', 'Vila Nova', 'São Paulo', 'SP', 'Contato recente', '1', NOW(), NOW()),
(2, 'Carlos Almeida', 'PJ', '12.345.678/0001-22', 'LOCADOR', 'carlos.almeida@empresa.com.br', '21987654321', '03000-000', 'Avenida C', '789', '', 'Jardim América', 'Rio de Janeiro', 'RJ', 'Novo cliente', '1', NOW(), NOW()),
(2, 'Fernanda Lima', 'PF', '345.678.901-23', 'PROPRIETARIO', 'fernanda.lima@email.com', '21976543210', '04000-000', 'Avenida D', '101', 'Bloco B', 'Barra', 'Rio de Janeiro', 'RJ', 'Favorável', '1', NOW(), NOW()),
(3, 'Lucas Pereira', 'PJ', '23.456.789/0001-33', 'COMPRADOR', 'lucas.pereira@empresa.com.br', '31987654321', '05000-000', 'Rua E', '202', '', 'Santa Tereza', 'Belo Horizonte', 'MG', 'Em avaliação', '0', NOW(), NOW()),
(3, 'Juliana Costa', 'PF', '456.789.012-34', 'VENDEDOR', 'juliana.costa@email.com', '31976543210', '06000-000', 'Rua F', '303', 'Casa 1', 'Funcionários', 'Belo Horizonte', 'MG', 'Solicitou contato', '1', NOW(), NOW()),
(4, 'Roberto Santos', 'PF', '567.890.123-45', 'LOCADOR', 'roberto.santos@email.com', '41987654321', '07000-000', 'Rua G', '404', '', 'Centro', 'Salvador', 'BA', 'Interessado em imóvel', '1', NOW(), NOW()),
(4, 'Patrícia Souza', 'PJ', '34.567.890/0001-44', 'PROPRIETARIO', 'patricia.souza@empresa.com.br', '41976543210', '08000-000', 'Rua H', '505', 'Apto 2', 'Pituba', 'Salvador', 'BA', 'Cliente VIP', '1', NOW(), NOW()),
(5, 'Gabriel Martins', 'PF', '678.901.234-56', 'VENDEDOR', 'gabriel.martins@email.com', '51987654321', '09000-000', 'Rua I', '606', 'Loja 3', 'Centro', 'Porto Alegre', 'RS', 'Em negociação', '0', NOW(), NOW()),
(5, 'Ana Beatriz', 'PF', '789.012.345-67', 'COMPRADOR', 'ana.beatriz@email.com', '51976543210', '10000-000', 'Rua J', '707', 'Apartamento 34', 'Cidade Baixa', 'Porto Alegre', 'RS', 'Contato recente', '1', NOW(), NOW());

INSERT INTO imoveis (
    id_cliente, id_loja, tipo_imovel, qtd_comodos, m2, qtd_fotos, endereco, endereco_numero, bairro, complemento, cidade, estado, cep, obs, status, dt_reg, dt_alt
) VALUES
(1, 1, 'CASA', 3, 120.50, 5, 'Rua das Flores', '123', 'Jardim Botânico', 'Casa com jardim', 'São Paulo', 'SP', '01000-000', 'Próxima ao parque', '1', NOW(), NOW()),
(2, 1, 'APTO', 2, 85.75, 3, 'Avenida Central', '456', 'Centro', 'Apto 101', 'São Paulo', 'SP', '02000-000', 'Vista para a cidade', '1', NOW(), NOW()),
(3, 2, 'LOJA', NULL, 50.00, 10, 'Rua das Flores', '789', 'Vila Nova', '', 'Rio de Janeiro', 'RJ', '03000-000', 'Espaço para estoque', '1', NOW(), NOW()),
(4, 2, 'COBERTURA', 4, 200.00, 8, 'Avenida Paulista', '101', 'Bela Vista', 'Cobertura duplex', 'São Paulo', 'SP', '04000-000', 'Vista panorâmica', '1', NOW(), NOW()),
(5, 3, 'TERRENO', NULL, NULL, 0, 'Rua do Campo', '202', 'Zona Rural', '', 'Belo Horizonte', 'MG', '05000-000', 'Área para construção', '1', NOW(), NOW()),
(6, 3, 'CASA', 4, 150.00, 6, 'Rua das Palmeiras', '303', 'São Pedro', 'Casa com piscina', 'Belo Horizonte', 'MG', '06000-000', 'Ótima localização', '1', NOW(), NOW()),
(7, 4, 'APTO', 3, 95.50, 4, 'Rua das Acácias', '404', 'Barra', 'Apto 303', 'Salvador', 'BA', '07000-000', 'Próximo à praia', '1', NOW(), NOW()),
(8, 4, 'CASA', 5, 180.00, 7, 'Avenida das Orquídeas', '505', 'Pituba', '', 'Salvador', 'BA', '08000-000', 'Espaço para eventos', '1', NOW(), NOW()),
(9, 5, 'LOJA', NULL, 75.00, 6, 'Rua das Oliveiras', '606', 'Centro', '', 'Porto Alegre', 'RS', '09000-000', 'Boa visibilidade', '1', NOW(), NOW()),
(10, 5, 'COBERTURA', 3, 250.00, 9, 'Avenida das Nações', '707', 'Cidade Baixa', 'Cobertura com varanda', 'Porto Alegre', 'RS', '10000-000', 'Luxuosa', '1', NOW(), NOW());

INSERT INTO contratos (
    id_loja, id_clientes, id_imovel, contrato, obs, dt_entrada, dt_saida, dt_reg, dt_alt
) VALUES
(1, 1, 1, 'Contrato de compra e venda de imóvel residencial.', 'Inclui cláusulas sobre garantia e prazo de entrega.', '2024-01-15', '2024-02-15', NOW(), NOW()),
(1, 2, 2, 'Contrato de aluguel de apartamento por 12 meses.', 'Apartamento no centro com direito a 1 vaga de garagem.', '2024-02-01', '2025-01-31', NOW(), NOW()),
(2, 3, 3, 'Contrato de locação comercial por 24 meses.', 'Loja com área para estoque e vitrine.', '2024-03-01', '2026-02-28', NOW(), NOW()),
(2, 4, 4, 'Contrato de compra e venda de cobertura duplex.', 'Inclui mobília e equipamentos de cozinha.', '2024-04-01', '2024-05-01', NOW(), NOW()),
(3, 5, 5, 'Contrato de venda de terreno para construção.', 'Inclui a liberação de documentação e estudos de viabilidade.', '2024-05-15', '2024-06-15', NOW(), NOW()),
(3, 6, 6, 'Contrato de aluguel de casa por 6 meses.', 'Casa com piscina e jardim.', '2024-06-01', '2024-12-01', NOW(), NOW()),
(4, 7, 7, 'Contrato de aluguel de apartamento na praia.', 'Inclui acesso ao clube e estacionamento.', '2024-07-01', '2025-06-30', NOW(), NOW()),
(4, 8, 8, 'Contrato de venda de imóvel residencial com cinco quartos.', 'Inclui piscina e churrasqueira.', '2024-08-15', '2024-09-15', NOW(), NOW()),
(5, 9, 9, 'Contrato de locação de loja no centro comercial.', 'Espaço ideal para pequeno varejo.', '2024-09-01', '2025-08-31', NOW(), NOW()),
(5, 10, 10, 'Contrato de venda de cobertura de luxo com varanda.', 'Inclui todos os móveis e eletrodomésticos.', '2024-10-01', '2024-11-01', NOW(), NOW());

INSERT INTO funcionarios (
    id_loja, nome, cpf, email, senha, telefone, cargo, salario, obs, status, dt_entrada, dt_saida, dt_reg, dt_alt
) VALUES
(1, 'Ana Souza', '12345678901', 'ana.souza@email.com', 'senha123', '11987654321', 'Gerente', 5000.00, 'Gerente de loja com excelente desempenho.', '1', '2023-01-10', NULL, NOW(), NOW()),
(1, 'Carlos Oliveira', '23456789012', 'carlos.oliveira@email.com', 'senha456', '11976543210', 'Vendedor', 3000.00, 'Vendedor experiente no setor de eletrônicos.', '1', '2023-02-15', NULL, NOW(), NOW()),
(2, 'Maria Santos', '34567890123', 'maria.santos@email.com', 'senha789', '21987654321', 'Assistente Administrativo', 3500.00, 'Responsável pelo suporte administrativo.', '1', '2023-03-20', NULL, NOW(), NOW()),
(2, 'Roberto Lima', '45678901234', 'roberto.lima@email.com', 'senha101', '21976543210', 'Financeiro', 4000.00, 'Controla as finanças da loja e realiza relatórios.', '1', '2023-04-01', NULL, NOW(), NOW()),
(3, 'Juliana Costa', '56789012345', 'juliana.costa@email.com', 'senha202', '31987654321', 'Coordenador de Vendas', 5500.00, 'Coordena equipe de vendas e estratégias comerciais.', '1', '2023-05-15', NULL, NOW(), NOW()),
(3, 'Lucas Pereira', '67890123456', 'lucas.pereira@email.com', 'senha303', '31976543210', 'Atendente', 2800.00, 'Atendimento ao cliente e suporte no balcão.', '1', '2023-06-10', NULL, NOW(), NOW()),
(4, 'Patrícia Fernandes', '78901234567', 'patricia.fernandes@email.com', 'senha404', '41987654321', 'Marketing', 4200.00, 'Desenvolve estratégias e campanhas de marketing.', '1', '2023-07-01', NULL, NOW(), NOW()),
(4, 'Fernando Silva', '89012345678', 'fernando.silva@email.com', 'senha505', '41976543210', 'Gerente de Loja', 6000.00, 'Gerencia todas as operações da loja.', '1', '2023-08-20', NULL, NOW(), NOW()),
(5, 'Aline Almeida', '90123456789', 'aline.almeida@email.com', 'senha606', '51987654321', 'Consultor Imobiliário', 3500.00, 'Consultoria e negociação de imóveis.', '1', '2023-09-05', NULL, NOW(), NOW()),
(5, 'Eduardo Martins', '01234567890', 'eduardo.martins@email.com', 'senha707', '51976543210', 'Assistente de Vendas', 3000.00, 'Auxilia nas vendas e atendimento ao cliente.', '1', '2023-10-01', NULL, NOW(), NOW());

INSERT INTO corretores (
    id_loja, id_funcionario, creci, obs, status, dt_reg, dt_alt
) VALUES
(1, 1, 'CRECI-SP 123456', 'Corretor com experiência em vendas residenciais.', '1', NOW(), NOW()),
(1, 2, 'CRECI-SP 234567', 'Especializado em imóveis comerciais.', '1', NOW(), NOW()),
(2, 3, 'CRECI-RJ 345678', 'Atuando no mercado imobiliário de alto padrão.', '1', NOW(), NOW()),
(2, 4, 'CRECI-RJ 456789', 'Focado em vendas e locações de imóveis de luxo.', '1', NOW(), NOW()),
(3, 5, 'CRECI-MG 567890', 'Consultor especializado em imóveis comerciais e industriais.', '1', NOW(), NOW()),
(3, 6, 'CRECI-MG 678901', 'Atua no setor de imóveis residenciais e terrenos.', '1', NOW(), NOW()),
(4, 7, 'CRECI-BA 789012', 'Corretor com vasta experiência em vendas de imóveis na praia.', '1', NOW(), NOW()),
(4, 8, 'CRECI-BA 890123', 'Especializado em imóveis para investidores.', '1', NOW(), NOW()),
(5, 9, 'CRECI-RS 901234', 'Atende clientes em busca de imóveis para compra e aluguel.', '1', NOW(), NOW()),
(5, 10, 'CRECI-RS 012345', 'Focado em imóveis residenciais e comerciais de médio porte.', '1', NOW(), NOW());

INSERT INTO fornecedores (
    id_loja, fornecedor, tipo, documento, tipo_forn, responsavel, email, telefone, descricao, obs, status, dt_reg, dt_alt
) VALUES
(1, 'Fornecedora de Materiais Ltda', 'PJ', '12.345.678/0001-90', 'PRODUTOS', 'José Silva', 'contato@materiaisltda.com.br', '11987654321', 'Fornecedor de materiais de construção', 'Entrega rápida', '1', NOW(), NOW()),
(1, 'Serviços Limpeza SP', 'PJ', '23.456.789/0001-01', 'SERVICO', 'Maria Oliveira', 'servicos@limpezasp.com.br', '11976543210', 'Serviços de limpeza para lojas e escritórios', 'Contrato renovado anualmente', '1', NOW(), NOW()),
(2, 'Distribuidora X', 'PJ', '34.567.890/0001-23', 'AMBOS', 'Carlos Almeida', 'distribuidora@distribuidorax.com.br', '21987654321', 'Distribuição de produtos e serviços diversos', 'Especialização em logística', '1', NOW(), NOW()),
(2, 'Importadora Internacional', 'ESTRANGEIRO', '1234567890', 'PRODUTOS', 'Anna Smith', 'info@importadoraintl.com', '21976543210', 'Importação de produtos eletrônicos', 'Negociações anuais', '1', NOW(), NOW()),
(3, 'TecnoServiços', 'PJ', '45.678.901/0001-45', 'SERVICO', 'Roberto Lima', 'contato@tecnoservicos.com.br', '31987654321', 'Serviços de manutenção e suporte técnico', 'Atendimento rápido', '1', NOW(), NOW()),
(3, 'Lojão das Ofertas', 'PJ', '56.789.012/0001-56', 'PRODUTOS', 'Juliana Costa', 'ofertas@lojaodaspromocoes.com.br', '31976543210', 'Venda de produtos de varejo com descontos', 'Preços competitivos', '1', NOW(), NOW()),
(4, 'Construtora ABC', 'PJ', '67.890.123/0001-67', 'AMBOS', 'Fernanda Souza', 'contato@construtoraabc.com.br', '41987654321', 'Serviços de construção e fornecimento de materiais', 'Parceria de longo prazo', '1', NOW(), NOW()),
(4, 'Design Studio', 'PF', '789.012.345-67', 'SERVICO', 'Eduardo Martins', 'design@studio.com.br', '41976543210', 'Serviços de design e consultoria', 'Projetos personalizados', '1', NOW(), NOW()),
(5, 'TechPro Suprimentos', 'PJ', '78.901.234/0001-78', 'PRODUTOS', 'Aline Almeida', 'suprimentos@techpro.com.br', '51987654321', 'Suprimentos e equipamentos tecnológicos', 'Fornecimento contínuo', '1', NOW(), NOW()),
(5, 'Consultoria Global', 'ESTRANGEIRO', '0987654321', 'SERVICO', 'Michael Brown', 'consultoria@global.com', '51976543210', 'Consultoria estratégica para negócios', 'Análise e relatórios detalhados', '1', NOW(), NOW());
