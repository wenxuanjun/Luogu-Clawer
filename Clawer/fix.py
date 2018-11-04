#!/usr/bin/python3

#依赖库
import os

#设置Luogu源文件和模板文件目录
#Warnling：末尾一定不能漏掉'/'
htmlfrom='/home/user/Luogu/'
templa='/home/user/temp.htm'

#读入题号和名称
broken=input()
to=input()

#先删掉它

os.system("rm -rf "+htmlfrom+'P'+str(broken)+".htm")

#复制一份模板过去
os.system("cp "+templa“+" "+htmlfrom+'P'+str(broken)+".htm")

#读入模板
get = open(htmlfrom+'P'+str(broken)+".htm",'r')
html = get.read()

#替换文字
html = html.replace("woc_luogu_is_so_bad","P"+str(broken)+" "+str(to))

#关闭模板
get.close()

#写文件
put = open(htmlfrom+'P'+str(broken)+".htm",'w')
put.write(html)
put.close()
