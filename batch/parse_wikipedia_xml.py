#!/usr/bin/python

import os, sys, re
from nltk.corpus import stopwords

dir_input = '/home/ubuntu/reactive-seo/data/wikipedia/input'
dir_output = '/home/ubuntu/reactive-seo/data/wikipedia/output/wiki.tsv'
page_info = {}
word_list = {}

openfile = open(dir_output, 'w')

dirs = sorted(os.listdir(dir_input))
for file in dirs:
  pathname = os.path.join(dir_input, file)
  if os.path.isfile(pathname) and file.startswith('enwiki-latest-pages-articles') and not file.startswith('.'):
    with open(pathname, "r") as ins:
      print "processing file: " + file
      page_title = ""
      for line in ins:
        line = line.strip()
        if line:
          if line.startswith('<title>') and line.endswith('</title>'):
            line = line.replace("<title>", "");
            line = line.replace("</title>", "");
            page_info[line] = []
            word_list = {}
            page_title = line
            print page_title
          elif line.startswith('[[Category:'):
            line = line.replace("[[Category:", "")
            line = line.replace("]]", "")
            line = line.replace("</text>", "")
            line = re.sub(r'[\W^\s]', ' ', line)
            words = line.split(' ')
            for word in words:
              if word:
                if word not in stopwords.words('english'):
                  if word_list.has_key(word):
                    word_list[word] = word_list[word] + 1
                    if word not in page_info[page_title]:
                      page_info[page_title].append(word)  
                      print word
                  else:
                    word_list[word] = 1 
          elif line.startswith('</revision>'):
            if len(page_info[page_title]) == 0:
              del page_info[page_title]            
            else:
              for word in page_info[page_title]:
                openfile.write("%s\t%s" % (page_title, word) + '\n')
              del page_info[page_title]
            page_title = ""
openfile.close()

