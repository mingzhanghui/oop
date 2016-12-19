#!/bin/bash

function dumpdb() {
    local DBNAME=$1

    cat > ~/.my.cnf <<EOF
[mysql]
user=root
password=root
host=localhost
database=${DBNAME}
socket=/opt/lampp/var/mysql/mysql.sock
EOF

    cat > ${DBNAME}.sql <<EOF
CREATE DATABASE IF NOT EXISTS ${DBNAME};
USE ${DBNAME};
EOF

    /opt/lampp/bin/mysqldump -uroot -hlocalhost -proot ${DBNAME} >> ${DBNAME}.sql
}

dumpdb mydatabase
