#!/usr/bin/python3

#依赖库
from bs4 import BeautifulSoup
import mysql.connector
import os

#从P(begin)到P(end)
begin=1000
end=4954
which = begin

#设置Luogu源文件目录
#警告：末尾一定不能漏掉'/'
htmlfrom='/home/user/Luogu/'

#数据库设置，注意别弄错了，否则会报错
mydb = mysql.connector.connect(
    # 数据库主机地址
    host="localhost", 
    # 数据库用户名
    user="luogu",
    # 数据库密码
    passwd="passwd",
    # 数据库名
    database="luogu"
)

while which <= end:
    
    #显示进度
    print("Yoxing:    P"+str(which))
    runon=(which-begin)/(end-begin)
    strunon='%.2f' % runon
    print("Yoxed:     "+strunon)
    os.system('clear')

    #打开文件
    #虽然html5lib解析器慢了点，但是它的兼容性非常好，若认为实在是慢(也就两分半)，可以采用lxml
    html = BeautifulSoup(open(htmlfrom+'P'+str(which)+'.htm'),"html5lib")
    
    #获取标题
    titlediv = html.body.find('div',class_='lg-toolbar')
    title = titlediv.h1.get_text()
    
    #截取题目和右边栏
    content = html.body.find('div',class_='am-g lg-main-content')
    
    #获取难度及时空限制
    status = content.find('div',class_='lg-summary-content')
    diff = status.find_all('strong',text="难度")[0].next_sibling.next_sibling.text
    limit = status.find_all('strong',text="时空限制")[0].next_sibling.next_sibling.text
    
    #截取题目主体
    passage = content.find('div',class_='lg-article am-g')
    
    #去除无用链接
    for useless in passage.find_all('a',class_='am-badge am-radius lg-bg-orange sample-copy'):
        useless.decompose()
        
    #截取标程，若无则为空
    stdcode=""
    if passage.find('div',class_='copy-region',id='stdcode') is not None:
        stddiv=passage.find('div',class_='copy-region',id='stdcode')
        
        #转换成字符串形式以免删除其父节点(stddiv)时丢失
        stdcode=str(stddiv.pre)
        
        #截取无用标题
        uslessh=stddiv.previous_sibling.previous_sibling
        
        #删除无用元素
        uslessh.decompose()
        stddiv.decompose()
    
    #转换成Bootstrap样式
    for amg in passage.find_all('div',class_='am-g'):
        amg['class']="row"
    for amd in passage.find_all('div',class_='am-u-md-6 copy-region'):
        amd['class']="col-md-6"
    
    #写入数据库
    mycursor = mydb.cursor() 
    sql = "INSERT INTO luogu (title,diff,limi,passage,stdcode) VALUES (%s,%s,%s,%s,%s)"
    val = (str(title),str(diff),str(limit),str(passage),str(stdcode))
    mycursor.execute(sql, val)
    mydb.commit()
    print(str(which)+" is OK")

    #循环变量
    which=which+1

#提示完毕
print("Done")
