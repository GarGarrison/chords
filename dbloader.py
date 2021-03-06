# -*- coding: utf-8 -*-
__author__ = 'plex and gar.garrison'

import os, sys
import json
import pandas
import warnings
import re
from dbapi import DBApi

BASE=os.getcwd()

# OLD_LINKS = "/home/garrison/Cloud/work/chords/util/export-post-2019-01-12_19-48-44.csv"
OLD_ARTIST = os.path.join(BASE, "util/check-chords-art+song.csv")
OLD_CONTENT = os.path.join(BASE, "util/URL-content.csv")

IN_DIR = os.path.join(BASE, "util/data_to_load")
OUT_DIR = os.path.join(BASE, "util/data_in_db")

# db = DBApi()
db = DBApi()

def read_old():
    r = re.compile("<iframe.*>.*</iframe?>")
    r_div = re.compile("<div.*?>")
    df_content = pandas.read_csv(OLD_CONTENT)
    df_artist = pandas.read_csv(OLD_ARTIST)
    songs = {}
    for index, row in df_artist[ df_artist["Песня"].notnull() ].iterrows():
        url = row["Old URL"]
        songs[url] = {
            "song_name": row["Песня"],
            "artist_name": row["Группа"]
        }
        if not pandas.isnull(row["Title"]): songs[url]["seo_title"] = row["Title"]
        if not pandas.isnull(row["Description"]): songs[url]["seo_description"] = row["Description"]

    for index, row in df_content.iterrows():
        url = row["URL"]
        data = songs[url]
        content = row["Content"]
        if r.findall(content): data["video"] = r.findall(content)[0]
        content = re.sub(r, '', content).strip()
        content = re.sub(r_div, '', content).strip()
        data["chords_txt"] = content.replace("_x000D_", "").replace("</div>", "").replace("<br>", "")
        try:
            db.insert_artist(data)
            newurl = db.insert_song(data)
            print("{},https://checkthechords.ru/{}".format(url, newurl))
        except Exception as e:
            print(data)
            raise

def read_file(fname):
    with open(fname, 'r') as f:
        return json.load(f)

def read_chords(func):
    def wrapper():
        i = 0

        # to test parsing
        for dirname in os.listdir(IN_DIR):
            for fname in os.listdir(os.path.join(IN_DIR, dirname)):
                fpath = os.path.join(os.path.join(IN_DIR, dirname), fname)
                try:
                    jsondata = read_file(fpath)
                    func(jsondata, dirname, fname, fpath)
                except Exception as e:
                    print(fpath)
                    raise
                i += 1
                if i % 1000 == 0:
                    print('Files processed: %s' % i)
    return wrapper

@read_chords
def insert_song(jsondata, dirname, fname, fpath):
    r = db.insert_song(jsondata)
    if r:
        newdir = os.path.join(OUT_DIR, dirname)
        olddir = os.path.join(IN_DIR, dirname)
        newfile = os.path.join(newdir, fname)
        if not os.path.exists(newdir): os.makedirs(newdir)
        os.rename(fpath, newfile)
        if len(os.listdir(olddir)) == 0: os.rmdir(olddir)


@read_chords
def insert_artist(jsondata, *args):
    db.insert_artist(jsondata)

if __name__ == '__main__':
    if sys.argv[1] == "video":
        db.update_video()
    else:
        insert_artist()
        insert_song()

    # read_old()



# db.close()
