# script to copy the latest search logs file onto HDFS
for FILE in `ls ~/reactive-seo/data/search-logs | sort -gr | head -1`
	do hdfs dfs -copyFromLocal -f ~/reactive-seo/data/search-logs/$FILE /reactive-seo/data/search-logs/
done