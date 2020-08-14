S1=1
S2=2
#S3=3
echo "{"
while IFS=, read -r field1 field2 field3 
do
    echo "\"$field1\":{"
    echo "\"$field1$S1\":{"
    echo "\"value\": \"`dig @$field2 $1 $2 +short`\""
    echo "},"
    echo "\"$field1$S2\":{"
    echo "\"value\": \"`dig @$field2 $1 $2 +short`\""
    echo "}"
    echo "},"
done < server.csv
echo "}"
