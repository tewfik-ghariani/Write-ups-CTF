#Chall3 - Forensics
 
### Texas 750 Pts

###### Files :
* Texas.iso

###### Hint :
You must become the best player!!


---

1) As you can notice, this disk is damaged. You must use a recovery tool in order to explore it. I advice using simply 'testdisk'

2) Using testdisk, you'll be able to recover a lot of files... all related to poker.. 
You'll first check the 'Flag' file but it looks like a dead end... Surely it will be used later..

3) After exploring the files, you'll come across an .odt file called 'best_player'... Keeping in mind the hint ' You Must become the best player ', this is the right path!

Ps: The file 'If you are indeed a poker player' is a decoy, its password is simply 123... but it leads no where..

4) in this file, you'll find a message and a picture 'Poker Face',

Message : In order to become the best player ever, simply follow this ...==>> 'Poker Face'

You must then study the picture ! (You can save it, or rename .odt to .zip and you'll find it in 'Pictures' File)

5) Using exiftool to study its meta-data : 
Thumbnail Image                 : (Binary data 48324 bytes, use -b option to extract)

6) Extract it binary data :
 
exiftool Poker\_Face -b > another\_picture

7) Using exiftool on 'another_picture'  you'll notice : 
Warning                         : Skipped unknown 227 byte header

You must understand that you'll have to delete some extra header

8) Once that done, you'll get a troll face that have some binary data in it as well
=>>>
exiftool troll\_face -b > last\_picture

9) You can repeat the same proccess on the last_picture (delete its extra header) to get a 'Success' picture, but that's optional
What we need here is to notice the comment among the 'last\_picture''s meta-data 

4\*2-4\*4-2\*3-5\*2-9\*4-0\*2-6\*2-3\*4-0\*1-7\*3-0\*2-2\*3-5\*2-5\*4

10) Remembering the 'Flag' file, you'll get this:

44-4444-222-55-9999-00-66-3333-0-777-00-222-55-5555

11) Simple stega Mobile to convert that to the flag!

==> Flag : 

<blockquote>             
h4ckz0n3 r0ck5
</blockquote>