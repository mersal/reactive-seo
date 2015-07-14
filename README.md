Reactive SEO
==============

Reactive SEO looks into the often overlooked world of web site meta data.  Most sites update their body content daily, yet their meta content is usually stagnant. Reactive SEO is a platform for real-time updating of meta open graph data based on related trending terms. Doing so should enhance content promotion, especially within the social graph.

## Links
- [Live Demo](http://reactive-seo.mersal.net/)
- [Presentation Slides](http://reactive-seo.mersal.net/about)
	
## Primary Use Case(s)
News outlets with varying subjects and content
![UI](http://reactive-seo.mersal.net/images/demo/newsoutlets.png)

## Real-Time Process
Reactive SEO takes the words found in the meta keyword and description fields, and matches them up with trending topics that are related to these meta terms. For example, for si.com, the meta keywords are extracted as:

    Sports illustrated, SI, SI.com, sports news, sports scores, sports highlights, sports rumors, nfl, college football, mlb, baseball, college basketball, nba, nhl, soccer, golf, fantasy

and meta description as:

    SI.com - sports news, scores, photos, columns and expert analysis from the world of sports including NFL, NBA, NHL, MLB, NASCAR, college basketball, college football, golf, soccer, tennis, fantasy and much more

These words are matched with related trending topics.  For example, words like 'sports' or 'basketball' would be matched with the Golden State Warriors, LeBron James, etc.

These trending topics are then get appended to the meta content: keywords and open graph description.  So the result is that once static meta content now becomes dynamic and more relevant.

![UI](http://reactive-seo.mersal.net/images/demo/transform1.png)

Now sharing a link on social media is even more relevant

![UI](http://reactive-seo.mersal.net/images/demo/updatedfb.png)

## Pipeline

![UI](http://reactive-seo.mersal.net/images/demo/pipeline.png)


## Data
- [Wikipedia Database Dump - XML](https://dumps.wikimedia.org/enwiki/latest/)
- [Google Hot Trends - XML](https://www.google.com/trends/hottrends)

## Technology Stack
- [AWS EC2] (http://aws.amazon.com/ec2/)
- [AWS HDFS] (https://hadoop.apache.org/docs/r1.2.1/hdfs_design.html)
- [Hive] (http://hive.apache.org/)
- [Presto] (https://prestodb.io/docs/current/index.html)
- [CodeIgniter] (https://ellislab.com/codeigniter/user-guide/)
- [Python] (https://www.python.org/)


