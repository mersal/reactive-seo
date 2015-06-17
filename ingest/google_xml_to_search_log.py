#!python

import xml.etree.ElementTree as ET
import wget, time, os, random

ts = int(time.time())
ts2 = ts - 15552000

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
  for num in range(1, 10000):
    x = str(random.randrange(ts2, ts))
    fo.write(x + "\t" + a.text + "\t")
    fo.write("\n")
fo.close()
