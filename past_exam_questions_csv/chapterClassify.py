import csv
with open('202011.csv', newline='') as csvfile:
    csvreader = csv.reader(csvfile, delimiter=',', quotechar='"')
    line_count = 0
    for row in csvreader:
        if line_count == 0:
            print("Read columns successfully. Now Reading content...")
            line_count += 1
        else:
            # print(line_count)
            line_count += 1
            data = row[7]  # 抓取每列的第八欄資料
            page = data.find("(")
            pageText = data[page:]  # 從找到前括號的索引輸出到結尾
            pageText = pageText.replace(")", "")
            pageText = pageText.replace("(", "")
            pageText = pageText.replace("**", "常用醫護術語")
            pageText = pageText.replace("*", "")
            print(pageText)
            # 在這邊寫章節判斷
