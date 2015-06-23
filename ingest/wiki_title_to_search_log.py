#!python

import time, os, random

ts = int(time.time())
ts2 = ts - 15552000
ts3 = ts + 2635932

path_data_ht = '/home/ubuntu/reactive-seo/data/wikipedia/'
path_data_sl = '/home/ubuntu/reactive-seo/data/search-logs/'
filename_out = path_data_sl + 'wiki-logs.tsv'
pathname = path_data_ht + 'seo_dict.txt'
fo = open(filename_out, 'w')

with open(pathname, "r") as ins:
  for line in ins:
    print "processing line: " + line
    line = line.strip()
    if line:
     if not line.startswith("Template:"):
       for num in range(1, random.randrange(10,100)):
         x = str(random.randrange(ts2, ts3))
         fo.write(x + "\t" + line + "\t")
         fo.write("\n")
fo.close()
