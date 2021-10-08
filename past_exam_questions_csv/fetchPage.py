import csv
with open('202004.csv', newline='') as csvfile:
    csvreader = csv.reader(csvfile, delimiter=',', quotechar='"')
    line_count = 0
    for row in csvreader:
        if line_count == 0:
            print("Read columns successfully. Now Reading content...")
            line_count += 1
        else:
            #print(line_count)
            line_count += 1
            data = row[1]  # 抓取每列的第二欄資料
            page = data.find("(*")
            # print(data[page+1:])  # 從找到問號的索引+1輸出到結尾
            pageText = data[page+1:]
            pageText = pageText.replace(")","")
            pageText = pageText.replace("**","常用醫護術語")
            pageText = pageText.replace("*","")
            # 在這邊寫章節判斷
            print(pageText)
