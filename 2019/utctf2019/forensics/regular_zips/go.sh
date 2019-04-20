
cp problem.txt hint.txt
cp RegularZips.zip archive.zip

while [[ -f hint.txt ]]
do

 exrex "$(cat hint.txt)" > passwords.txt


 pwd=$(fcrackzip -D -p passwords.txt -u archive.zip | grep pw | cut -d'=' -f3)

 pwd=${pwd:1}
 echo $pwd
 rm hint.txt
 mv archive.zip old.zip

 unzip -P "$pwd" old.zip
 rm old.zip
done
