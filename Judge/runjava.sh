ulimit -t $2
../java/bin/java $1 <./intext > ./progoutput
#echo $?
exit $?
