DROP TABLE wikipedia_dump;
CREATE TEMPORARY TABLE IF NOT EXISTS wikipedia_dump ( wiki_title string, wiki_desc string)
ROW FORMAT DELIMITED FIELDS TERMINATED BY "\t" LINES TERMINATED BY "\n"
STORED AS TEXTFILE LOCATION '/reactive-seo/data/wikipedia';

DROP TABLE wikipedia_dict;
CREATE TABLE wikipedia_dict row format delimited fields terminated by '\t'
AS
SELECT wiki_title, wiki_desc 
FROM wikipedia_dump;

