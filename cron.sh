#/bin/bash

ids=$(sqlite3 app/database/production.sqlite "SELECT id FROM shares WHERE expiration > date('now')")
for id in $ids
do
	sqlite3 app/database/production.sqlite "DELETE FROM shares WHERE id=$id"
	sqlite3 app/database/production.sqlite "DELETE FROM photos WHERE share_id=$id"
done