#!/bin/bash

echo "==== Provisionando Servidor de Base de Datos ===="

# Actualizar sistema
apt-get update

# Instalar PostgreSQL
echo "Instalando PostgreSQL..."
apt-get install -y postgresql postgresql-contrib

# Configurar PostgreSQL para aceptar conexiones remotas
echo "Configurando PostgreSQL..."

# Permitir conexiones desde la red privada
echo "host all all 192.168.56.0/24 md5" >> /etc/postgresql/14/main/pg_hba.conf

# Escuchar en todas las interfaces
sed -i "s/#listen_addresses = 'localhost'/listen_addresses = '*'/" /etc/postgresql/14/main/postgresql.conf

# Crear usuario y base de datos
sudo -u postgres psql <<EOF
CREATE USER webuser WITH PASSWORD 'webpass123';
CREATE DATABASE webappdb OWNER webuser;
\c webappdb
CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (nombre, email) VALUES
('Juan Pérez', 'juan@example.com'),
('María García', 'maria@example.com'),
('Carlos López', 'carlos@example.com');

GRANT ALL PRIVILEGES ON TABLE usuarios TO webuser;
GRANT USAGE, SELECT ON SEQUENCE usuarios_id_seq TO webuser;
EOF

# Reiniciar PostgreSQL
systemctl restart postgresql

echo "==== Base de datos PostgreSQL configurada exitosamente ===="
echo "Conexión: postgresql://webuser:webpass123@192.168.56.11:5432/webappdb"
