from dbapi import DBApi
from dbapi import Song
import os

dbapi = DBApi()

img_path = "/home/garrison/Cloud/work/chords/public/img/chords/guitar"
img_chords = list(map(lambda x: x.replace(".gif", ""), os.listdir(img_path)))

badchords = set()

songs = dbapi.session.query(Song).all()
for song in songs:
    chords = song.guitar_chords.split(";")
    for ch in chords:
        if ch not in img_chords:
            badchords.add(ch)

print(sorted(badchords))
print(len(badchords))

"""
rename IMGS:
rename 's/_0//' *
rename 's/w/#/' *

SQL QUERIES:

update songs
	set guitar_chords = REPLACE(guitar_chords, "/", "|")

update songs
	set guitar_chords = REPLACE(guitar_chords, ")", "")

update songs
	set guitar_chords = REPLACE(guitar_chords, "maj", "")

update songs
	set guitar_chords = REPLACE(guitar_chords, "Cb", "H")

update songs
	set guitar_chords = REPLACE(guitar_chords, "Db", "C#")

update songs
	set guitar_chords = REPLACE(guitar_chords, "Eb", "D#")

update songs
	set guitar_chords = REPLACE(guitar_chords, "Ab", "G#")

update songs
	set guitar_chords = REPLACE(guitar_chords, "Amb", "G#m")

update songs
	set guitar_chords = REPLACE(guitar_chords, "Bb", "A#")

update songs
	set guitar_chords = REPLACE(guitar_chords, "Gb", "F")

"""
