CREATE EXTERNAL TABLE IF NOT EXISTS seo_dict_merge (term_replacement string, term_trending string, meta_term string, count_all_time bigint, count_last_hour bigint, count_last_day bigint, count_last_week bigint, count_last_month bigint);
INSERT OVERWRITE TABLE seo_dict_merge
SELECT distinct seo_dict.term1 as term_replacement, search_logs.term as term_trending, lower(seo_dict.term2) as meta_term, 
if (ISNULL(search_logs_all_time.count_term),0,search_logs_all_time.count_term) as count_all_time,
if (ISNULL(search_logs_last_hour.count_term),0,search_logs_last_hour.count_term) as count_last_hour,
if (ISNULL(search_logs_last_day.count_term),0,search_logs_last_day.count_term) as count_last_day,
if (ISNULL(search_logs_last_week.count_term),0,search_logs_last_week.count_term) as count_last_week,
if (ISNULL(search_logs_last_month.count_term),0,search_logs_last_month.count_term) as count_last_month
from seo_dict
join search_logs on lower(seo_dict.term1) = lower(search_logs.term)
left join
search_logs_all_time on lower(search_logs.term) = lower(search_logs_all_time.term)
left join
search_logs_last_hour on lower(search_logs.term) = lower(search_logs_last_hour.term)
left join
search_logs_last_day on lower(search_logs.term) = lower(search_logs_last_day.term)
left join
search_logs_last_week on lower(search_logs.term) = lower(search_logs_last_week.term)
left join
search_logs_last_month on lower(search_logs.term) = lower(search_logs_last_month.term);
