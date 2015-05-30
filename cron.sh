#/bin/bash
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

ids=$(sqlite3 $DIR/app/database/production.sqlite "SELECT id FROM shares WHERE expiration < date('now')")
for id in $ids
do
	sqlite3 $DIR/app/database/production.sqlite "DELETE FROM shares WHERE id=$id"
	sqlite3 $DIR/app/database/production.sqlite "DELETE FROM photos WHERE share_id=$id"
done