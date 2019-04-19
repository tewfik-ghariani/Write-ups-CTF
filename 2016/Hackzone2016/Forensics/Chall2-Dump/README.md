# Chall2 - Forensics
 
### Dump 350 Pts

###### Files :
* Dump.raw.tar.bz2

###### No Hints
---



1)  tar xjfv Dump.raw.tar.bz2

2) This is a memory dump, you must understand that you'll be using volatility !

3) First step is to find out the operating system that was running on the computer from which we got the memory dump!

```
volatility -f Dump.raw imageinfo
```

=> Win2008R2SP1x64



3) First reflex is to check the list of process which were running! 

```
volatility -f Dump.raw pslist --profile=Win2008R2SP1x64
```

4) Obviously, the process 'flag.'  will catch your eyes !

5) Execute this to dump it locally !

```
 volatility -f  Dump.raw  --profile=Win2008R2SP1x64 procexedump -p 1804 -D .
```


6) execute it or simply use `strings` 


===> The Flag Is 

<blockquote>
Th4nks_f0r_c0m1ng
</blockquote>





---

See you next year !

###### #Hackzone2017


