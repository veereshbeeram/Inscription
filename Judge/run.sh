ulimit -t $1
./sandbox/run <./sandbox/intext > ./sandbox/progoutput
#echo $?
exit $?
