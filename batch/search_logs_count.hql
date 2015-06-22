DROP TABLE search_logs;
CREATE EXTERNAL TABLE IF NOT EXISTS search_logs (ts float, term string)
ROW FORMAT DELIMITED FIELDS TERMINATED BY "\t" LINES TERMINATED BY "\n"
STORED AS TEXTFILE LOCATION '/reactive-seo/data/search-logs';

CREATE EXTERNAL TABLE IF NOT EXISTS search_logs_last_hour (term string, count_term bigint);
INSERT OVERWRITE TABLE search_logs_last_hour 
SELECT term, count(term) as count_term
FROM search_logs
where (UNIX_TIMESTAMP() - ts) <= 3600
GROUP BY term;

CREATE EXTERNAL TABLE IF NOT EXISTS search_logs_last_day (term string, count_term bigint);
INSERT OVERWRITE TABLE search_logs_last_day
SELECT term, count(term) as count_term
FROM search_logs
where (UNIX_TIMESTAMP() - ts) <= 86400
GROUP BY term;

CREATE EXTERNAL TABLE IF NOT EXISTS search_logs_last_week (term string, count_term bigint);
INSERT OVERWRITE TABLE search_logs_last_week
SELECT term, count(term) as count_term
FROM search_logs
where (UNIX_TIMESTAMP() - ts) <= 604800
GROUP BY term;

CREATE EXTERNAL TABLE IF NOT EXISTS search_logs_last_month (term string, count_term bigint);
INSERT OVERWRITE TABLE search_logs_last_month
SELECT term, count(term) as count_term
FROM search_logs
where (UNIX_TIMESTAMP() - ts) <= 2678400
GROUP BY term;

CREATE EXTERNAL TABLE IF NOT EXISTS search_logs_all_time (term string, count_term bigint);
INSERT OVERWRITE TABLE search_logs_all_time
SELECT term, count(term) as count_term
FROM search_logs
GROUP BY term;

