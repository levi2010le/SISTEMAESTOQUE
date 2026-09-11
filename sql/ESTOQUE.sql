CREATE DATABASE ESTOQUE;
 
USE ESTOQUE;
 
CREATE TABLE tb_produtos (

    cd_produto INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,

    nm_produto VARCHAR(255) NOT NULL,

    ds_produto VARCHAR(60),

    qt_estoque INT NOT NULL DEFAULT 0,
    
    img_produto VARCHAR(255),

    vl_produto DECIMAL(10,2) NOT NULL
 
);
 
 
CREATE TABLE tb_compras (

    cd_compra INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

    cd_produto INT NOT NULL,

    qt_compra INT NOT NULL,

    vl_compra DECIMAL(10,2) NOT NULL,

    dt_compra DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 
    CONSTRAINT fk_compra_produto FOREIGN KEY (cd_produto) REFERENCES tb_produtos(cd_produto)

);
 
 
CREATE TABLE tb_vendas (

    cd_venda INT NOT NULL AUTO_INCREMENT PRIMARY KEY,

    cd_produto INT NOT NULL,

    qt_venda INT NOT NULL,

    vl_venda DECIMAL(10,2) NOT NULL,

    dt_venda DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
 
    CONSTRAINT fk_venda_produto FOREIGN KEY (cd_produto) REFERENCES tb_produtos(cd_produto)

);
 
INSERT INTO tb_produtos (nm_produto, ds_produto, qt_estoque, vl_produto) VALUES 
('Biscoito', 'Biscoito de chocolate ao creme de avelã', 10, 4.50),
('Leite Integral', 'Leite integral 1L de alta qualidade', 25, 3.80),
('Pão Francês', 'Pão francês fresco diariamente', 50, 1.20),
('Queijo Meia Cura', 'Queijo meia cura 500g importado', 15, 18.90),
('Ovos Caipira', 'Dúzia de ovos caipira frescos', 30, 8.50),
('Iogurte Natural', 'Iogurte natural 500g sem aditivos', 20, 5.60),
('Manteiga', 'Manteiga sem sal 200g premium', 18, 12.30),
('Café Premium', 'Café 500g grão torrado especial', 22, 15.90),
('Arroz Integral', 'Arroz integral 5kg beneficiado', 12, 22.00),
('Feijão Carioca', 'Feijão carioca 2kg safra nova', 16, 8.70),
('Macarrão Integral', 'Macarrão integral 500g orgânico', 28, 4.20),
('Azeite Extra Virgem', 'Azeite extra virgem 500ml premium', 14, 35.50),
('Açúcar Cristal', 'Açúcar cristal 1kg refinado', 40, 3.50),
('Sal Refinado', 'Sal refinado 1kg iodado', 35, 2.10),
('Mel Puro', 'Mel puro 500ml sem aditivos', 19, 24.90);

 