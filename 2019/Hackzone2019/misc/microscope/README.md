# Microscope - Misc

### Points : #
### Solved : #

###### Files :
None

######  Hints
None

---


# Walkthrough

We were provided with a link that simply outputs different dots with different colors. Went ahead and downloaded its source code
Once downloaded, searched specifically for all hex code of the colors using silver-searcher


```
ag -o  \#[A-Z0-9]*< view-source_149.56.110.180_1234.html | tee colors.txt
```

After printifying the output, decoded to to ascii
```
sed 's/#//g' colors.txt  | tr -d [:space:] | xxd -r -p > flag.gif
```
Got a gif file containing multiple QR code images.

![alt flag](flag.gif)

Proceeded by splitting it into frames.

```
mkdir target

convert flag.gif  target/target.png

```
Then used the zbar to decode the QR codes and retrieve the flag!

```
for i in $(seq 0 49); do echo $f ; zbarimg target/target-${i}.png ; done | grep Code | cut -d':' -f2 | tr -d [:space:]

```
## Flag

HZVII{7h3\_0r161n4l\_qr\_c0d3\_w45\_d3v3l0p3d\_1n\_1994.}




