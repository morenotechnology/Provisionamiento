# 🧩 Taller: Vagrant con Provisionamiento mediante Shell

## 🎯 Objetivo
Aprender a crear y configurar máquinas virtuales con **Vagrant**, utilizando **scripts de provisionamiento (Shell)** para instalar servicios y desplegar aplicaciones web básicas con **Apache, PHP y PostgreSQL**.

## ⚙️ Pasos de instalación
1. **Clonar el repositorio**
   git clone https://github.com/jmaquin0/vagrant-web-provisioning.git
   cd vagrant-web-provisioning

2. **Verificar la estructura del proyecto**
   ├── Vagrantfile
   ├── provision-web.sh
   ├── provision-db.sh


3. **Levantar las máquinas virtuales**
   vagrant up

4. **Verificar servicios**
   - Web: http://192.168.56.10
   - PHP: http://192.168.56.10/info.php
   - DB: PostgreSQL en 192.168.56.11:5432

## 📜 Scripts utilizados

### 🖥️ provision-web.sh
Instala y configura Apache, PHP y sus módulos.

sudo apt update -y
sudo apt install -y apache2 libapache2-mod-php php php-pgsql
sudo systemctl enable apache2
sudo systemctl restart apache2

### 🗄️ provision-db.sh
Instala PostgreSQL, crea base de datos y usuario, y ejecuta el script seed.sql.

sudo apt update -y
sudo apt install -y postgresql postgresql-contrib
ejemplo:
sudo -u postgres psql -c "CREATE ROLE appuser LOGIN PASSWORD 'secret123';"
sudo -u postgres createdb -O appuser appdb

### 🌐 Archivos del sitio
- index.html: Página de bienvenida personalizada.
- info.php: Muestra información PHP o conecta a la base de datos PostgreSQL y lista datos de ejemplo.

## 🖼️ Capturas de pantalla
- index funcionando: ./captures/index.png
- info.php funcionando: ./captures/info_php.png
- conexión base de datos: ./captures/db_connect.png

