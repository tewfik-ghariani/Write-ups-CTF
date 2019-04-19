# Chall1 - Forensics
 
### Gravity 300 Pts

###### Files :
* _Call\_Newton.wav_
* _isaac.jpg_

###### Hint :
Node but not js !!!

---


1) binwalk  isaac.jpg ; you will notice that it contains binary data for zip files

2) Rename isaac.jpg => isaac.zip

3) Decode Call_Newton.wav via a DTMF online Decoder,

_Example_ : http://www.dialabc.com/sound/detect/index.html

=> 598#AB998CD1AB01C

4) Use that password to unzip isaac.zip

5) Files : 

+ _Flag.tar.bz2_
+ _Format_

6) tar xjvf Flag.tar.bz2
=> A bunch of empty files

You must then build a binary tree using their names 

7) Considering the hint, you should understand that you'll be using those nodes to get the flag. So, simply get the leafs :
121481179510348116954911695991045277112


8) Then Adjust it using the Format :

```
`___ __ ___ __ ___ __ ___ __ __ ___ __ __ ___ __ __ ___`
'121 48 117 95 103 48 116 95 49 116 95 99 104 52 77 112'
```

9)  Final step, decode it from Decimal to Ascii :

=> And the flag is : 

<blockquote>
y0u_g0t_1t_ch4Mp
</blockquote>