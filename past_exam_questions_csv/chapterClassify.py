import csv


def proccessMultiPage(pageTextIn):
    if(pageTextIn.find("~") != -1):
        return pageTextIn[0:pageTextIn.find("~")]
    elif(pageTextIn.find("-") != -1):
        return pageTextIn[0:pageTextIn.find("-")]
    elif(pageTextIn.find("、") != -1):
        return pageTextIn[0:pageTextIn.find("、")]
    elif(pageTextIn.find(",") != -1):
        return pageTextIn[0:pageTextIn.find(",")]
    else:
        return pageText  # Can't Find any special characters


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
            if(page == -1):  # 保留自己標記的null
                page = 0
            pageText = data[page:]  # 從找到前括號的索引輸出到結尾
            pageText = pageText.replace(")", "")
            pageText = pageText.replace("(", "")
            pageText = pageText.replace("**", "常用醫護術語")
            pageText = pageText.replace("*", "")
            # print(pageText)
            try:
                x = pageText.find("常用")
                if(x == -1):  # 非常用醫護術語再進一步處理
                    pageText = proccessMultiPage(pageText)  # 處理多頁數標記
                    pageInt = (int)(pageText)
                    # 在這邊寫章節判斷
                else:
                    print(pageText)
            except ValueError:
                print(pageText)  # Oops not able to convert to integer
