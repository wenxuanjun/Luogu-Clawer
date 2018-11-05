#/bin/bash

#我是不是应该在这里写一些胡乱的东西来假装Shell写了很多呢？

#也许会很有用哦OvO

#皮皮真开心  ——鲁迅

mkdir Luogu
for ((which = 1000; which <= 4954; i++)); do wget https://www.luogu.org/problemnew/show/P$which -O Luogu/$which.htm; done
