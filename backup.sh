#!/usr/bin/env bash
WORKDIR=/opt/lampp/htdocs/oop
PROJECT_NAME=contact
PROJECT_DIR=${WORKDIR}/${PROJECT_NAME}
BACKUP_ZIP=${PROJECT_NAME}-`date +%F`.zip

cd ${PROJECT_DIR}/sql
./dump.sh

cd ${WORKDIR}

zip -r ${BACKUP_ZIP} ${PROJECT_NAME}

n=$(mount | sed -n '/\/media\/mzh\/老毛桃U盘/p' | wc -l)
if [ $n -eq 1 ]; then
    if [ -d "/media/mzh/老毛桃U盘/phpObject" ]; then
	cp ${BACKUP_ZIP} "/media/mzh/老毛桃U盘/phpObject/"
    else
	cp ${BACKUP_ZIP} "/media/mzh/老毛桃U盘/"
    fi
    echo "syncing /media/mzh/老毛桃U盘/..."
    sync
fi
echo "Done.";
