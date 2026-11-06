CREATE TABLE clientes (
    id INT AUTO_INCREMENT NOT NULL,
    
    /*Tipo de cliente: F (Físico) ou J (Jurídico)*/
    tipo VARCHAR(1) NOT NULL,
    
    nomeSocial VARCHAR(70) NOT NULL,
    email VARCHAR(70) NOT NULL,
    
    nomeCompleto VARCHAR(70),
    cpf VARCHAR(30),
    razaoSocial VARCHAR(70),
    cnpj VARCHAR(30),
    
    CONSTRAINT pk_clientes PRIMARY KEY (id)
);