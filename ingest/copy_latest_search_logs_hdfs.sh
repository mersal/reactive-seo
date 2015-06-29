<<<<<<< HEAD
for FILE in `ls ~/reactive-seo/data/search-logs | sort -gr | head -1`
	do hdfs dfs -copyFromLocal -f ~/reactive-seo/data/search-logs/$FILE /reactive-seo/data/search-logs/
done
=======
# script to copy the latest search logs file onto HDFS
for FILE in `ls ~/reactive-seo/data/search-logs | sort -gr | head -1`
	do hdfs dfs -copyFromLocal -f ~/reactive-seo/data/search-logs/$FILE /reactive-seo/data/search-logs/
done
>>>>>>> 29d4439e956a7ebfb7b0856d87af6ba218a4c525
