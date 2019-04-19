# Sniffer - Forensics

### Points : #
### Solved : #

###### Files :
sniffer.rar

######  Hints
None

---


# Walkthrough

Unraring the sniffer.rar file will extract a pcap file containing captured network trafic. After opening the file using wireshark, there a are a lot of UDP and TCP streams but extracting them wasn't helpful.

That being said, taking a look at the "Ethernet" packets was actually helpful as each one of them contains some data. We can filter the packets using tshark given that these packets have fixed length (29)



```
$  tshark -r pcap_sniffer.pcap -Y '((frame.len == 29))'
  262  75.983811 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  263  75.986726 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  264  75.987725 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  265  75.988776 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  266  75.989697 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  267  75.990853 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  268  75.991871 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  269  75.992966 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  270  75.993987 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  271  75.994926 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  272  75.995933 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  273  75.996932 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  274  75.997886 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  275  75.999012 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  276  76.000019 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  277  76.001019 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  278  76.001986 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  279  76.003135 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  280  76.004500 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  281  76.005722 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  282  76.037106 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  283  76.038075 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  284  76.039100 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  285  76.040085 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  286  76.041019 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  287  76.042006 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  288  76.043057 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  289  76.044099 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  290  76.045035 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  291  76.045973 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  292  76.046954 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  293  76.047919 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  294  76.048853 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  295  76.049791 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  296  76.050780 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II
  297  76.051738 Applicon_01:6c:cf → 45:00:00:1d:00:01 0x0a00 29  Ethernet II

```

We can simply extract the data via this command

```
$ tshark -r pcap_sniffer.pcap -Y '((frame.len == 29))'  -T  fields -e data
020f010101010800a4ff0000000053
020f010101010800b1ff0000000046
020f01010101080087ff0000000070
020f010101010800a0ff0000000057
020f010101010800a4ff0000000053
020f010101010800a2ff0000000055
020f0101010108008bff000000006c
020f010101010800c0ff0000000037
020f01010101080096ff0000000061
020f010101010800b3ff0000000044
020f010101010800b5ff0000000042
020f010101010800c4ff0000000033
020f0101010108009fff0000000058
020f010101010800c5ff0000000032
020f010101010800a6ff0000000051
020f0101010108007fff0000000078
020f0101010108009dff000000005a
020f010101010800b1ff0000000046
020f010101010800beff0000000039
020f010101010800c2ff0000000035
020f010101010800aaff000000004d
020f010101010800afff0000000048
020f010101010800a1ff0000000056
020f01010101080091ff0000000066
020f0101010108009dff000000005a
020f0101010108008dff000000006a
020f010101010800b1ff0000000046
020f01010101080082ff0000000075
020f0101010108009dff000000005a
020f010101010800b1ff0000000046
020f010101010800beff0000000039
020f01010101080083ff0000000074
020f010101010800aaff000000004d
020f0101010108007dff000000007a
020f010101010800beff0000000039

```

Now we just go other the data and extract the last two bits while removing extra spaces

```
$ for val in $(tshark -r pcap_sniffer.pcap -Y '((frame.len == 29))'  -T  fields -e data ); do a=${val:28:2}; echo $a ; done | tr -d [:space:] 
5346705753556c3761444233583251785a4639354d4856665a6a46755a4639744d7a3939
```
This is interesting, we can decode this from hex to ascii

```
$ echo 5346705753556c3761444233583251785a4639354d4856665a6a46755a4639744d7a3939 | xxd -r -p
SFpWSUl7aDB3X2QxZF95MHVfZjFuZF9tMz99
```

This sounded like it is encoded in base64, let's verify that

```
$ echo SFpWSUl7aDB3X2QxZF95MHVfZjFuZF9tMz99 | base64 -d
HZVII{h0w_d1d_y0u_f1nd_m3?}
```



That's it! Here is the one liner :
```
$ for val in $(tshark -r pcap_sniffer.pcap -Y '((frame.len == 29))'  -T  fields -e data ); do a=${val:28:2}; echo $a ; done | tr -d [:space:] | xxd -r -p | base64 -d
HZVII{h0w_d1d_y0u_f1nd_m3?}
```


## Flag

HZVII{h0w\_d1d\_y0u\_f1nd\_m3?}



