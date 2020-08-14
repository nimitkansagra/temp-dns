if [ $# -eq 0 ]
then
	echo "Usage : googlens.sh [website / ip] [NS / A / MX / AAA]"
else
	dig @8.8.8.8 $1 $2 +short
fi
