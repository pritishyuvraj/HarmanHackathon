a = open("temp2.csv", "r")
i = 0
prev = 1
d = {}
def changeOfDate(d, date):
	#print d
	for elements in d:
		text = ""
		text2 = ""
		for e in d[elements]:
			text += (str(e)+ " ")
			text2 += (str(e)+ " ")
		text = text.strip(',')
		text += "\n"
		text2 = text2.strip(',')
		text2 += "\n"
		with open("db2.csv", "a") as myfile:
			myfile.write(text)
		#with open("db2.csv", "a") as myfile:
		#	myfile.write(text2)	
	d = {}
	return d

for line in a:
	line = line.split(',')
	if len(line) < 2:
		exit()
	#line[4] = line[4].strip()
	#line[4] = [int(i) for i in line[4]]
	line[4] = int(line[4])
	#print "Prev, Car, Desti, Date:", prev, line[0], line[1], line[4] 
	if prev!= line[4]:
		prev = line[4]
		#print "Not matching ", prev, line[4], type(prev), type(line[4])
		d = changeOfDate(d, line[4])
	if line[0] not in d:
		d.setdefault(line[0], [])	
	d[line[0]].append(line[1])	
	i+=1
d = changeOfDate(d, line[4])	