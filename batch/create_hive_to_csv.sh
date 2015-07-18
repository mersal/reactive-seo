hive -e 'select * from seo_dict_merge' > seo_dict_merge.csv
hive -e 'select * from search_logs_last_hour' > search_logs_last_hour.csv
hive -e 'select * from search_logs_last_day' > search_logs_last_day.csv
hive -e 'select * from search_logs_last_week' > search_logs_last_week.csv
hive -e 'select * from search_logs_last_month' > search_logs_last_month.csv
hive -e 'select * from search_logs_all_time' > search_logs_all_time.csv
sudo mv *.csv /var/lib/mysql/

