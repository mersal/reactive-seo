DROP TABLE search_logs;
CREATE TEMPORARY TABLE IF NOT EXISTS search_logs ( ts float, term string)
ROW FORMAT DELIMITED FIELDS TERMINATED BY "\t" LINES TERMINATED BY "\n"
STORED AS TEXTFILE LOCATION '/reactive-seo/data/search-logs';

DROP TABLE search_logs_last_hour;
CREATE TABLE search_logs_last_hour row format delimited fields terminated by '\t'
AS
SELECT term, count(term) as count_term
FROM search_logs
where (UNIX_TIMESTAMP() - ts) <= 3600
GROUP BY term;

DROP TABLE search_logs_last_day;
CREATE TABLE search_logs_last_day row format delimited fields terminated by '\t'
AS
SELECT term, count(term) as count_term
FROM search_logs
where (UNIX_TIMESTAMP() - ts) <= 86400
GROUP BY term;

DROP TABLE search_logs_last_week;
CREATE TABLE search_logs_last_week row format delimited fields terminated by '\t'
AS
SELECT term, count(term) as count_term
FROM search_logs
where (UNIX_TIMESTAMP() - ts) <= 604800
GROUP BY term;

DROP TABLE search_logs_last_month;
CREATE TABLE search_logs_last_month row format delimited fields terminated by '\t'
AS
SELECT term, count(term) as count_term
FROM search_logs
where (UNIX_TIMESTAMP() - ts) <= 2678400
GROUP BY term;

DROP TABLE search_logs_all_time;
CREATE TABLE search_logs_all_time row format delimited fields terminated by '\t'
AS
SELECT term, count(term) as count_term
FROM search_logs
GROUP BY term;

