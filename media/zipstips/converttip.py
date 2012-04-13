import os
from time import strptime
import calendar
from BeautifulSoup import BeautifulSoup
import sqlite3
import re

s = ""
conn = sqlite3.connect('zipstips.db')
c = conn.cursor()
for file in os.listdir("."):
    if os.path.abspath(file).endswith('html'):
        f = open(file)
        html = f.read()
        soup = BeautifulSoup(html)
        for row in soup.find('table', width="850").findAll('tr'):
            cols= row.findAll('td')
            if cols[0].contents[0] != "&nbsp;":
                i = 0
                values = []
                for col in cols:
                    contents = col.renderContents()
                    contents = contents.replace("&quot;", "\"")
                    contents = contents.strip()
                    values.append(contents)
                values[0] = calendar.timegm(strptime(values[0], "%b %d, %Y"))
                values[1] = values[1].replace("\"", "")
                values[1] = re.sub(r'<[^>]*?>', '', values[1])
                values[1] = values[1].strip()
                values[2] = re.sub(r'<[^>]*?>', '', values[2])
                values[2] = re.sub(' +',' ',values[2])
                values[2] = values[2].strip()
                print values
                c.execute("insert into tips values(?, ?, ?)", values)
                conn.commit()
        f.close()
c.close
