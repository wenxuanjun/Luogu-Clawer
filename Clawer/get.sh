#/bin/bash

mkdir Luogu
for ((which = 1000; which <= 4954; i++)); do wget https://www.luogu.org/problemnew/show/P$which -O Luogu/$which.htm; done
