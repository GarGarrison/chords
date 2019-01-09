# -*- coding: utf-8 -*-
__author__ = 'plex and gar.garrison'
import os
import json
import configparser

from dbapi import DBApi

IN_DIR = '/home/garrison/Cloud/work/chords/util/data_to_load'
OUT_DIR = '/home/garrison/Cloud/work/chords/util/data_in_db'

c = "[dummy_section]\n" + open(".env").read()
config = configparser.ConfigParser()
config.read_string(c)
host = config["dummy_section"]["DB_HOST"]
database = config["dummy_section"]["DB_DATABASE"]
username = config["dummy_section"]["DB_USERNAME"]
password = config["dummy_section"]["DB_PASSWORD"]

db = DBApi(host=host, user=username, passwd=password, db=database, charset='utf8')

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
                        func(db, jsondata, dirname, fname, fpath)
                    except Exception as e:
                        print(fpath)
                        raise
                    i += 1
                    if i % 1000 == 0:
                        print('Files processed: %s' % i)
    return wrapper

@read_chords
def insert_song(db, jsondata, dirname, fname, fpath):
    r = db.insert_song(jsondata)
    if r:
        newdir = os.path.join(OUT_DIR, dirname)
        olddir = os.path.join(IN_DIR, dirname)
        newfile = os.path.join(newdir, fname)
        if not os.path.exists(newdir): os.makedirs(newdir)
        os.rename(fpath, newfile)
        if len(os.listdir(olddir)) == 0: os.rmdir(olddir)


@read_chords
def insert_artist(db, jsondata, *args):
    db.insert_artist(jsondata)

if __name__ == '__main__':
    insert_artist()
    insert_song()

db.close()
