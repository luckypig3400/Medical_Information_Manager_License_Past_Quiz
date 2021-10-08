import csv
with open('202011.csv', newline='') as csvfile:
    spamreader = csv.reader(csvfile, delimiter=',', quotechar='"')
    line_count = 0
    for row in spamreader:
        if line_count ==0:
            print("Read columns successfully. Now Reading content...")
            line_count += 1
        else:
            print(line_count)
            line_count += 1
            data = row[1] # 抓取每列的第二欄資料
            page = data.find("？")
            print(data[page+1:]) # 從找到問號的索引+1輸出到結尾 
