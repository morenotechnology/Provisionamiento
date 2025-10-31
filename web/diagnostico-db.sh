#!/bin/bash

echo "======================================"
echo "  DIAGNÓSTICO COMPLETO DE LA BD"
echo "======================================"
echo ""

echo "1️⃣  Estado de las VMs:"
vagrant status
echo ""

echo "2️⃣  PostgreSQL corriendo?"
vagrant ssh db -c "sudo systemctl is-active postgresql"
echo ""

echo "3️⃣  Bases de datos:"
vagrant ssh db -c "sudo -u postgres psql -l"
echo ""

echo "4️⃣  Usuarios en la tabla:"
vagrant ssh db -c "sudo -u postgres psql -d webappdb -c 'SELECT * FROM usuarios;'"
echo ""

echo "5️⃣  Configuración de red:"
vagrant ssh db -c "sudo cat /etc/postgresql/14/main/pg_hba.conf | grep 192.168.56"
echo ""

echo "6️⃣  Puerto 5432 abierto?"
vagrant ssh db -c "sudo netstat -tlnp | grep 5432"
echo ""

echo "======================================"
echo "  FIN DEL DIAGNÓSTICO"
echo "======================================"
