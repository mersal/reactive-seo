DROP INDEX IF EXISTS search_logs_last_hour_index ON search_logs_last_hour;
CREATE INDEX search_logs_last_hour_index ON TABLE search_logs_last_hour (term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_last_hour_index ON search_logs_last_hour REBUILD;
SHOW FORMATTED INDEX ON search_logs_last_hour;

DROP INDEX IF EXISTS search_logs_last_day_index ON search_logs_last_day;
CREATE INDEX search_logs_last_day_index ON TABLE search_logs_last_day (term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_last_day_index ON search_logs_last_day REBUILD;
SHOW FORMATTED INDEX ON search_logs_last_day;

DROP INDEX IF EXISTS search_logs_last_week_index ON search_logs_last_week;
CREATE INDEX search_logs_last_week_index ON TABLE search_logs_last_week (term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_last_week_index ON search_logs_last_week REBUILD;
SHOW FORMATTED INDEX ON search_logs_last_week;

DROP INDEX IF EXISTS search_logs_last_month_index ON search_logs_last_month;
CREATE INDEX search_logs_last_month_index ON TABLE search_logs_last_month (term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_last_month_index ON search_logs_last_month REBUILD;
SHOW FORMATTED INDEX ON search_logs_last_month;

DROP INDEX IF EXISTS search_logs_all_time_index ON search_logs_all_time;
CREATE INDEX search_logs_all_time_index ON TABLE search_logs_all_time (term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_all_time_index ON search_logs_all_time REBUILD;
SHOW FORMATTED INDEX ON search_logs_all_time;

DROP INDEX IF EXISTS wiki_title_index ON wikipedia_dict;
CREATE INDEX wiki_title_index ON TABLE wikipedia_dict (wiki_title) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX wiki_title_index ON wikipedia_dict REBUILD;
SHOW FORMATTED INDEX ON wikipedia_dict;

DROP INDEX IF EXISTS wiki_desc_index ON wikipedia_dict;
CREATE INDEX wiki_desc_index ON TABLE wikipedia_dict (wiki_desc) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX wiki_desc_index ON wikipedia_dict REBUILD;
SHOW FORMATTED INDEX ON wikipedia_dict;

DROP INDEX IF EXISTS search_logs_count_last_hour_index ON search_logs_last_hour;
CREATE INDEX search_logs_count_last_hour_index ON TABLE search_logs_last_hour (count_term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_count_last_hour_index ON search_logs_last_hour REBUILD;
SHOW FORMATTED INDEX ON search_logs_last_hour;

DROP INDEX IF EXISTS search_logs_count_last_day_index ON search_logs_last_day;
CREATE INDEX search_logs_count_last_day_index ON TABLE search_logs_last_day (count_term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_count_last_day_index ON search_logs_last_day REBUILD;
SHOW FORMATTED INDEX ON search_logs_last_day;

DROP INDEX IF EXISTS search_logs_count_last_week_index ON search_logs_last_week;
CREATE INDEX search_logs_count_last_week_index ON TABLE search_logs_last_week (count_term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_count_last_week_index ON search_logs_last_week REBUILD;
SHOW FORMATTED INDEX ON search_logs_last_week;

DROP INDEX IF EXISTS search_logs_count_last_month_index ON search_logs_last_month;
CREATE INDEX search_logs_count_last_month_index ON TABLE search_logs_last_month (count_term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_count_last_month_index ON search_logs_last_month REBUILD;
SHOW FORMATTED INDEX ON search_logs_last_month;

DROP INDEX IF EXISTS search_logs_count_all_time_index ON search_logs_all_time;
CREATE INDEX search_logs_count_all_time_index ON TABLE search_logs_all_time (count_term) AS 'COMPACT' WITH DEFERRED REBUILD;
ALTER INDEX search_logs_count_all_time_index ON search_logs_all_time REBUILD;
SHOW FORMATTED INDEX ON search_logs_all_time;

