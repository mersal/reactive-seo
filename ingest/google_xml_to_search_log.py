#!python

import xml.etree.ElementTree as ET
import wget, time, os, random

ts = int(time.time())
ts2 = ts - 15552000
ts3 = ts + 2635932
ts4 = ts - 86400

path_data_ht = '/home/ubuntu/reactive-seo/data/hot-trends/'
path_data_sl = '/home/ubuntu/reactive-seo/data/search-logs/'
filename_out = path_data_sl + 'search-logs.tsv.' + str(ts)
filename_xml = path_data_ht + 'hot-trends.xml'
if os.path.exists(filename_xml):
  os.remove(filename_xml)
url = 'https://www.google.com/trends/hottrends/atom/feed?pn=p1'
fo = open(filename_out, "w")
f = wget.download(url, filename_xml)
root = ET.parse(f).getroot()
for a in root.findall("channel/item/title"):
  print "processing trend: " + a.text
  for num in range(1, random.randrange(10000,50000)):
    x = str(random.randrange(ts4, ts))
    fo.write(x + "\t" + a.text + "\t")
    fo.write("\n")
for a in root.findall("channel/item/description"):
  if a.text:
    print "processing trend: " + a.text
    words = a.text.split(', ')
    for word in words:
      for num in range(1, random.randrange(10000,50000)):
        x = str(random.randrange(ts4, ts))
        fo.write(x + "\t" + a.text + "\t")
        fo.write("\n")
fo.close()

#if os.path.exists(filename_out):
#  os.system("hdfs dfs -copyFromLocal -f " + filename_out + " /reactive-seo/data/search-logs/")

