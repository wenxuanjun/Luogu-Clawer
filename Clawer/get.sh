#/bin/bash

mkdir Luogu
for ((i = 1000; i <= 1001; i++)); do wget https://www.luogu.org/problemnew/show/P$i -O Luogu/$i.htm; done
