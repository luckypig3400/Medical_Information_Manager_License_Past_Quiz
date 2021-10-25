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


def chapterClassifier(pageIntIn):
    if(pageInt >= 1 and pageInt <= 20):
        print(1)
    elif(pageInt >= 21 and pageInt <= 40):
        print(2)
    elif(pageInt >= 41 and pageInt <= 64):
        print(3)
    elif(pageInt >= 65 and pageInt <= 76):
        print(4)
    elif(pageInt >= 77 and pageInt <= 96):
        print(5)
    elif(pageInt >= 97 and pageInt <= 132):
        print(6)
    elif(pageInt >= 133 and pageInt <= 154):
        print(7)
    elif(pageInt >= 155 and pageInt <= 166):
        print(8)
    elif(pageInt >= 167 and pageInt <= 200):
        print(9)
    elif(pageInt >= 201 and pageInt <= 210):
        print(10)
    elif(pageInt >= 211 and pageInt <= 224):
        print(11)
    elif(pageInt >= 225 and pageInt <= 242):
        print(12)
    elif(pageInt >= 243 and pageInt <= 260):
        print(13)
    elif(pageInt >= 261 and pageInt <= 274):
        print(14)
    elif(pageInt >= 275 and pageInt <= 312):
        print(15)
    elif(pageInt >= 313 and pageInt <= 336):
        print(16)
    elif(pageInt >= 337 and pageInt <= 352):
        print(17)
    elif(pageInt >= 353 and pageInt <= 372):
        print(18)
    elif(pageInt >= 373 and pageInt <= 400):
        print(19)
    elif(pageInt >= 401 and pageInt <= 412):
        print(20)
    elif(pageInt >= 413 and pageInt <= 422):
        print(21)
    elif(pageInt >= 423 and pageInt <= 438):
        print(22)
    elif(pageInt >= 439 and pageInt <= 452):
        print(23)
    elif(pageInt >= 453 and pageInt <= 466):
        print(24)
    elif(pageInt >= 467 and pageInt <= 504):
        print(25)
    elif(pageInt >= 505 and pageInt <= 524):
        print(26)
    elif(pageInt >= 525 and pageInt <= 534):
        print(27)
    elif(pageInt >= 535 and pageInt <= 558):
        print(28)
    elif(pageInt >= 559 and pageInt <= 574):
        print(29)
    elif(pageInt >= 575 and pageInt <= 594):
        print(30)
    elif(pageInt >= 595 and pageInt <= 616):
        print(31)
    elif(pageInt >= 617 and pageInt <= 638):
        print(32)
    elif(pageInt >= 639 and pageInt <= 650):
        print(33)
    elif(pageInt >= 651 and pageInt <= 664):
        print(34)
    elif(pageInt >= 665):
        print(35)
    else:
        print("Page not belong to any Chapter!")


with open('201303.csv', newline='') as csvfile:
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
                    chapterClassifier(pageInt)
                else:
                    print(pageText)
            except ValueError:
                print(pageText)  # Oops not able to convert to integer
