from __future__ import division

import csv
import operator
import time
import math
start = time.time()
#database = open("database_final2", "r")
database = open("db2.csv", "r")
distinct_webaddr = {}
no_of_lines = 0
for line in database:
	no_of_lines = no_of_lines + 1
	line1 = line.split()
	for web_addr in line1[:]:
		if web_addr not in distinct_webaddr:
			distinct_webaddr.setdefault(web_addr,1)
		else:
			distinct_webaddr[web_addr]+=1
webaddr = sorted(distinct_webaddr.items(), key=operator.itemgetter(1))
#print len(webaddr)
#with open("sample_out.txt", "w") as file:
#	writer = csv.writer(file, delimiter="\t")
#	writer.writerows(webaddr)
# 2% confidence 
temp_dict = {}
temp_pair = {}
#confidence_level = 0.05 * len(distinct_webaddr)
confidence_level = 0.2 * no_of_lines
confidence_level = math.floor(confidence_level)
#print "webaddr ", webaddr
for web in webaddr:
	if web[1] > confidence_level:
		temp_dict.setdefault(web[0],0)
		#temp_pair.setdefault(web[0],0)
		temp_dict[web[0]] = web[1]
d = {}
for webaddress in temp_dict:
	#print webaddress
	d[webaddress] = d.get(webaddress, {})
	for another in temp_dict:
		d[webaddress][another] = 0
	
#print d
database.seek(0)
for line in database:
	prev = ""
	webaddr = line.split()
	i = 2
	for addr in webaddr[:]:
		#print "starts", addr
		#print "ends"
		for pair_words in webaddr[i:]:
			prev = addr
			present = pair_words
			#print "Pair", prev, present
			if prev == present:
				continue
			if (prev in d) and (present in d):
				#print "Previous ",prev
				#print "present is ", present
				#print d[present]
				d[prev][present] += 1
		i = i+1
#print d	
#temp_e = {}
#
'''
for i in d:
	for j in d[i]:
		if d[i][j] > confidence_level:
			print(i, j, d[i][j]),
	print " "
'''
index_i = 0
index_j =0
value = 0
for i in d:
	for j in d[i]:
		if value < d[i][j]:
			value = d[i][j]
			index_i = i
			index_j = j

					
'''
#ceck_dict = max_dict/6
for from_web in d:
	for to_web in d[from_web]:
		print d[from_web][to_web]
		if d[from_web][to_web] > max_dict:
			print d[from_web][to_web]
'''


def determine_confidence(string1):
	count = 0
	#print "String is ", string1
	for line in database:
		#print "line is ", line
		if all(word in line for word in string1):
			count = count+1
			#print "got one here ", count
	return count

def algorithm(result_list, vertex, a2D_matrix,support_value):
	count = 0

	#print "Vertex ", vertex
	#print "List ", result_list

	for ver in a2D_matrix[vertex]:
		#print vertex, ver, a2D_matrix[vertex][ver]
		if (a2D_matrix[vertex][ver] >= support_value) and (ver not in result_list) :
			result_list.append(ver)
			#print result_list
			algorithm(result_list, ver, a2D_matrix, support_value)
			count = count + 1
	if count < 1 :
		if len(result_list) > 1: 
			database.seek(0)
			#confidence = 0
			confidence = determine_confidence(result_list)
			#print "Confidence level ", confidence
			if confidence >= confidence_level:
				#print result_list
				time = []
				order = []
				backwards = 0
				settings = 0
				for timinig in result_list:
					get_time = timinig.split(';')
					get_work = get_time[0]
					get_time = int(get_time[1])
					if get_time >= backwards:
						backwards = get_time
						get_work = str(get_work) + " @time: " + str(get_time)
						order.append(get_work)
						settings = 0
					else:
						settings = 1
						break
				if settings == 0:
					#print order
					for matter in order:
						print matter
			#else:
				#print "Failed here ", confidence, result_list
		del result_list[-1]
		return
	del result_list[-1]
	return	
for i in d:
	result = []
	result.append(i)
	algorithm(result, i, d, confidence_level)
end = time.time()
'''
print "Duration time ", end - start
print "No of Lines ", no_of_lines
print "Confidence Bar ", confidence_level
print "Start location ", index_i
print "jth index ", index_j
'''