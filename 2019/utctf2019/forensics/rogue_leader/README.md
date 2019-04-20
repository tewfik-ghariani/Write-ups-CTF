# Rogue Leader - Forensics

### Points : #
### Solved : #

###### Files :
capture.pcapng

######  Hints
None

---


# Walkthrough

Given a pcap file, we can just go ahead and launch wireshark in order to analyze the captured traffic.

After going through the packets, it is easy to spot that the USB protocol is being put into use. 
Here is the list of protocols extracted from the exported packets.


```

$ cut -d',' -f5 packets.csv  | sort -u
"ARP"
"DNS"
"Protocol"
"TCP"
"TLSv1.2"
"USB"
"USBMS"

```

Now in order to display only USB packets, we can use the following query

```
((usb.transfer_type == 0x01) && (frame.len == 72)) && !(usb.capdata == 00:00:00:00:00:00:00:00)
```

Let's put it into use via tshark by extracting _capdata_

```
tshark -r capture.pcapng -Y '((usb.transfer_type == 0x01) && (frame.len == 72)) && !(usb.capdata == 00:00:00:00:00:00:00:00)' -T fields -e usb.capdata  | sed 's/://g' | tee hexout
```

```
$ tshark -r capture.pcapng -Y '((usb.transfer_type == 0x01) && (frame.len == 72)) && !(usb.capdata == 00:00:00:00:00:00:00:00)' -T fields -e usb.capdata  | sed 's/://g' | tee hexout
00000a0000000000
0000130000000000
00000a0000000000
00000a2c00000000
00002c0000000000
00002d0000000000
0000060000000000
00002c0000000000
0000090000000000
0000090f00000000
00000f0000000000
0000040000000000
0000040a00000000
00000a0000000000
0000160a00000000
0000160000000000
0000370000000000
0000130000000000
0000131100000000
0000110000000000
00000a0000000000
0000280000000000
0000180000000000
0000170000000000
0200000000000000
0200110000000000
0200000000000000
0200120000000000
0200000000000000
0200170000000000
0200000000000000
0000090000000000
00000f0000000000
0000040000000000
00000a0000000000
0200000000000000
02002f0000000000
0200000000000000
0000170000000000
0000150000000000
00001c0000000000
0200000000000000
02002d0000000000
0200000000000000
00000b0000000000
0000040000000000
0000041500000000
0000150000000000
0000070000000000
0000080000000000
0000081500000000
0000150000000000
0200000000000000
0200300000000000
0200000000000000
0000280000000000
0000180000000000
0000170000000000
0200000000000000
0200110000000000
0200000000000000
0200120000000000
0200000000000000
0200170000000000
0200000000000000
0000090000000000
00000f0000000000
0000040000000000
00000a0000000000
0200000000000000
02002f0000000000
0200000000000000
0000170000000000
0000150000000000
00001c0000000000
0200000000000000
02002d0000000000
0200000000000000
00000b0000000000
0000040000000000
0000150000000000
0000070000000000
0000080000000000
0000081500000000
0000150000000000
0200000000000000
0200300000000000
0200000000000000
0000280000000000
0000060000000000
0000130000000000
00002c0000000000
0000090000000000
00000f0000000000
0000040000000000
00000a0000000000
00000a1600000000
0000160000000000
0000370000000000
0000130000000000
0000110000000000
00000a0000000000
0000370000000000
00000a0000000000
0000130000000000
00000a0000000000
00002c0000000000
0000380000000000
0000100000000000
0000080000000000
0000070000000000
00000c0000000000
0000040000000000
0000380000000000
0000180000000000
0000160000000000
0000160800000000
0000080000000000
0000150800000000
0000150000000000
0000380000000000
0200000000000000
0200180000000000
0200000000000000
0200160000000000
0200000000000000
0200050000000000
0200000000000000
0000380000000000
0000280000000000
```

Now this is really interesting. This appears to be a key logger capture leftover data. According to the following article, we can use this hex output in order to map it with the appropriate key strokes.

Ref : https://medium.com/@ali.bawazeeer/kaizen-ctf-2018-reverse-engineer-usb-keystrok-from-pcap-file-2412351679f4

We can use the _map_keystrokestool.py_ script

```

$ python map_keystrokestool.py hexout
gpg  _c fllagggs.pnng
utNoTflag{try_harrderr}
utNoTflag{try_harderr}
cp flagss.png.gpg /media/useeer/UsB/

```

Boom! We got what we needed. However it's not over yet. Trying to submit that flag didn't work. Went back to the USB streams and extracted all left over data via the following command

```
infile=capture.pcapng
outfile=out
ext=txt

mkdir -p usb_output
tshark -r $infile -Y 'usb.capdata and usb.device_address==2' -T text

for usb_no in $(tshark -r $infile -Y 'usb.capdata and usb.device_address==2' -T fields -e _ws.col.No. )
do
   echo "Processing USB LeftOverCapture $usb_no : ${outfile}_usb_${usb_no}.${ext}"
   tshark -nlr $infile -Y "frame.number == ${usb_no}" -T fields -e usb.capdata | xxd -r -p > usb_output/${outfile}_usb_${usb_no}.${ext}
done

```

A couple of files were retrieved

```
$ for usb_no in $(tshark -r $infile -Y 'usb.capdata and usb.device_address==2' -T fields -e _ws.col.No. )
> do
>    echo "Processing USB LeftOverCapture $usb_no : ${outfile}_usb_${usb_no}.${ext}"
>    tshark -nlr $infile -Y "frame.number == ${usb_no}" -T fields -e usb.capdata | xxd -r -p > usb_output/${outfile}_usb_${usb_no}.${ext}
> done
Processing USB LeftOverCapture 51496 : out_usb_51496.txt
Processing USB LeftOverCapture 51510 : out_usb_51510.txt
Processing USB LeftOverCapture 51525 : out_usb_51525.txt
Processing USB LeftOverCapture 51532 : out_usb_51532.txt
Processing USB LeftOverCapture 51554 : out_usb_51554.txt
Processing USB LeftOverCapture 51566 : out_usb_51566.txt
Processing USB LeftOverCapture 51580 : out_usb_51580.txt

```

It seems that one of them in particular is actually a GPG encrypted file

```
$ file usb_output/*
usb_output/out_usb_51496.txt: data
usb_output/out_usb_51510.txt: data
usb_output/out_usb_51525.txt: data
usb_output/out_usb_51532.txt: GPG symmetrically encrypted data (AES256 cipher)
usb_output/out_usb_51554.txt: data
usb_output/out_usb_51566.txt: data
usb_output/out_usb_51580.txt: data

```

We will assume that was the flags file which was encrypted via GPG as stated before.
```
$ mv usb_output/out_usb_51532.txt flags.png.gpg

$ file flags.png.gpg 
flags.png.gpg: GPG symmetrically encrypted data (AES256 cipher)
```


Now we just need to decrypt it using the password fetched above ; utNOTflag{try_harder}

```
gpg -d flags.png.gpg > flag.png

utNOTflag{try_harder}
utNOTflag{try_harder}
```

Got the following picture!

![alt flag](flag.png)

Now we just need to retrieve the LSB from the image ( Ref : https://github.com/Aqcurate/lsb-steganography )

```
$ python3 steglsb.py -d flag.png 1 flag_1LSBs.png
[*] Attempting LSB Decoding with bits = 1
[*] Steg image mode: RGBA
[*] Created outfile at flag_1LSBs.png
```

![alt flag_lsb](flag_1LSBs.png)



PS : Unfortunately, I faced some issues with the uppercase/lowercase choice and I was running out of time so could not run all possibilities. As a result, I wasn't able to submit the flag before the contest end, but at least I got most of the trick :) 


## Flag

utflag{t3x45_1s_my_f4v0r1te_c0untry}


