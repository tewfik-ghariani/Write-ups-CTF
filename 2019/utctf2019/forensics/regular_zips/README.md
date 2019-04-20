# Regular Zips - Forensics

### Points : #
### Solved : #


###### Files :
[RegularZips.zip](RegularZips.zip)

######  Hints
None

---


# Walkthrough

We are provided with a password protected Zip Files and the following description

[_problem.txt_](problem.txt)

```
^	7	y	RU[A-Z]KKx2 R4\d[a-z]B	N$
```

We have to somehow use that, extract the content of the zipped file and solve the challenge.


It came to my attention that the problem might actually be a regular expression that we can match in order to crack the compressed file.

Came across the following cli which generates all sort of combinations related to a regex.

```
$  exrex "$(cat problem.txt)" | tee passwords.txt | wc
   6760   33800  141960
```
```
$ exrex "$(cat problem.txt)" | tail
	7	y	RUZKKx2 R49qB	N
	7	y	RUZKKx2 R49rB	N
	7	y	RUZKKx2 R49sB	N
	7	y	RUZKKx2 R49tB	N
	7	y	RUZKKx2 R49uB	N
	7	y	RUZKKx2 R49vB	N
	7	y	RUZKKx2 R49wB	N
	7	y	RUZKKx2 R49xB	N
	7	y	RUZKKx2 R49yB	N
	7	y	RUZKKx2 R49zB	N
```
Sweet! We can now generate our own dictionnaries and use them to crack the zip file. 

```
$ fcrackzip -D -p passwords.txt -u RegularZips.zip 


PASSWORD FOUND!!!!: pw == 	7	y	RUHKKx2 R47gB	N
```

Unzipping resulted in a new hint.txt file which will most likely also use to crack a new password protected archive.zip :D 
```
$ pwd=$(fcrackzip -D -p passwords.txt -u archive.zip | grep pw | cut -d'=' -f3)
$ pwd=${pwd:1}
```
```
$ unzip -P "$pwd" archive.zip 
Archive:  archive.zip
 extracting: hint.txt                
replace archive.zip? [y]es, [n]o, [A]ll, [N]one, [r]ename: y
 extracting: archive.zip  
```
```
[ Sat Apr 20 02:10:50 |  tewfik@tewfik-X555LJ |  ~/Documents/capture_the_flag/Write-ups-CTF/2019/utctf2019/forensics/regular_zips ] (master)  
$ cat hint.txt 
^\d00	2[a-z]F\s3u8J 1NzvA3l$
[ Sat Apr 20 02:12:21 |  tewfik@tewfik-X555LJ |  ~/Documents/capture_the_flag/Write-ups-CTF/2019/utctf2019/forensics/regular_zips ] (master)  
$ unzip archive.zip 
Archive:  archive.zip
[archive.zip] hint.txt password: 

```

There might be a chance that this process would be repeated again and again.. What should we do then? Automate it!

=> [go.sh](go.sh)

```
bash go.sh


...
Archive:  old.zip
  inflating: hint.txt                
 extracting: archive.zip             
lk6Y3WMZWunzX29rwfSQ
Archive:  old.zip
 extracting: hint.txt                
 extracting: archive.zip             
5LH Qry4LGqKd F0pC
Archive:  old.zip
 extracting: hint.txt                
 extracting: archive.zip             
BB rl aMF u 7o A0 b
Archive:  old.zip
  inflating: flag.txt   
```

After around 1000 iterations, we get the flag! ^^

```
$ cat flag.txt 
utflag{bean_pure_omission_production_rally}
```


## Flag

utflag{bean\_pure\_omission\_production\_rally}


