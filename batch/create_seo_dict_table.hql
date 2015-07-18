Drop table seo_dict;
CREATE EXTERNAL TABLE IF NOT EXISTS seo_dict (term1 string, term2 string)
ROW FORMAT DELIMITED FIELDS TERMINATED BY "\t" LINES TERMINATED BY "\n"
STORED AS TEXTFILE LOCATION '/reactive-seo/data/seo-dict';
