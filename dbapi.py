# -*- coding: utf-8 -*-
__author__ = 'gar.garrison'

import MySQLdb
import datetime, re
from sqlalchemy import Column, DateTime, String, Integer, ForeignKey, create_engine
from sqlalchemy.orm import sessionmaker
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.exc import IntegrityError

import configparser
c = "[dummy_section]\n" + open(".env").read()
config = configparser.ConfigParser()
config.read_string(c)
host = config["dummy_section"]["DB_HOST"]
database = config["dummy_section"]["DB_DATABASE"]
username = config["dummy_section"]["DB_USERNAME"]
password = config["dummy_section"]["DB_PASSWORD"]

Base = declarative_base()

class Artist(Base):
    __tablename__ = 'artists'

    id = Column(Integer, primary_key=True)
    artist_name = Column(String, nullable=False)
    url = Column(String, unique=True, nullable=False)
    letter = Column(String(3), nullable=False)
    avatar = Column(String, nullable=True)
    seo_title = Column(String, nullable=True)
    seo_description = Column(String, nullable=True)
    seo_keywords = Column(String, nullable=True)
    created_at = Column(DateTime, nullable=False)
    updated_at = Column(DateTime, nullable=False)

    def __repr__(self):
        return '<Artist {}>'.format(self.artist_name)

class Song(Base):
    __tablename__ = 'songs'

    id = Column(Integer, primary_key=True)
    artist_id = Column(Integer, ForeignKey("artists.id"), nullable=False)
    artist_name = Column(String, nullable=False)
    song_name = Column(String, nullable=False)
    chords_txt = Column(String, nullable=False)
    url = Column(String, unique=True, nullable=False)
    video = Column(String, unique=True, nullable=True)
    guitar_chords = Column(String, nullable=True)
    ukulele_chords = Column(String, nullable=True)
    seo_title = Column(String, nullable=True)
    seo_description = Column(String, nullable=True)
    seo_keywords = Column(String, nullable=True)
    view = Column(Integer, nullable=False, default=0)
    created_at = Column(DateTime, nullable=False)
    updated_at = Column(DateTime, nullable=False)

    def __repr__(self):
        return '<Song {} - {}>'.format(self.artist_name, self.song_name)

class DBApi(object):
    """
    expected json fields
        song_name
        chords_txt
        artist_name
        guitar_chords
    """

    db_location = "mysql://{}:{}@{}/{}?charset=utf8".format(username, password, host, database)
    session = None
    engine = None
    def __init__(self):
        engine = create_engine(self.db_location)
        Session = sessionmaker(engine)
        self.session = Session()
        self.engine = engine
        self.artists = [i.artist_name for i in self.session.query(Artist).all()]

    def _translit(self, st):
        st = st.lower()
        st = st.replace( ' ', '-' )
        st = st.replace( '/', '' )
        st = st.replace( '%', '' )
        st = st.replace( ',', '' )
        st = st.replace( '?', '' )
        st = st.replace( '"', '' )
        st = st.replace( "'", '' )
        st = st.replace( "(", '' )
        st = st.replace( ")", '' )
        st = st.replace( '_', '-' )
        st = st.replace( 'а', 'a' )
        st = st.replace( 'б', 'b' )
        st = st.replace( 'в', 'v' )
        st = st.replace( 'г', 'g' )
        st = st.replace( 'д', 'd' )
        st = st.replace( 'е', 'e' )
        st = st.replace( 'ё', 'e' )
        st = st.replace( 'ж', 'zh' )
        st = st.replace( 'з', 'z' )
        st = st.replace( 'и', 'i' )
        st = st.replace( 'й', 'j' )
        st = st.replace( 'к', 'k' )
        st = st.replace( 'л', 'l' )
        st = st.replace( 'м', 'm' )
        st = st.replace( 'н', 'n' )
        st = st.replace( 'о', 'o' )
        st = st.replace( 'п', 'p' )
        st = st.replace( 'р', 'r' )
        st = st.replace( 'с', 's' )
        st = st.replace( 'т', 't' )
        st = st.replace( 'у', 'u' )
        st = st.replace( 'ф', 'f' )
        st = st.replace( 'х', 'h' )
        st = st.replace( 'ц', 'c' )
        st = st.replace( 'ч', 'ch' )
        st = st.replace( 'ш', 'sh' )
        st = st.replace( 'щ', 'shc' )
        st = st.replace( 'ъ', '' )
        st = st.replace( 'ы', 'i' )
        st = st.replace( 'ь', '' )
        st = st.replace( 'э', 'e' )
        st = st.replace( 'ю', 'ju' )
        st = st.replace( 'я', 'ja' )
        return st

    def _get_now(self):
        return datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')

    # def _prepare_text(self, text):
    #     text = text.replace("'", r"\'")
    #     text = text.replace('"', r'\"')
    #     return text

    def _artist_id_by_name(self, name):
        artist = self.session.query(Artist).filter(Artist.artist_name == name).first()
        if not artist: raise BaseException("no such artist ({0})!".format(name))
        return artist.id

    def _get_last_song_id(self):
        last_song = self.session.query(Song).order_by(Song.id.desc()).first()
        if not last_song: raise BaseException("no songs!")
        return last_song.id + 1

    def _get_song_url(self, artist, title):
        url = "{0}-{1}".format(self._translit(artist),self._translit(title))
        count = self.session.query(Song).filter(Song.url == url).count()
        if count > 0: url = "{0}_{1}".format(url,self._get_last_song_id())
        return url

    def _fill_object(self, obj, data):
        for k in data: obj.__setattr__(k, data[k])
        return obj

    def insert_song(self, data):
        song_name = data.get("song_name", None)
        artist_name = data.get("artist_name", None)
        chords_txt = data.get("chords_txt", None)
        guitar_chords = data.get("chords", "")
        if not song_name: raise BaseException("empty song_name!")
        if not chords_txt: raise BaseException("empty chords_txt!")
        if not artist_name: raise BaseException("empty artist_name!")
        data["url"] = self._get_song_url(artist_name, song_name)
        data["guitar_chords"] = ";".join(guitar_chords)
        data["artist_id"] = self._artist_id_by_name(artist_name)
        data["created_at"] = self._get_now()
        data["updated_at"] = self._get_now()
        song = self._fill_object(Song(), data)
        try:
            self.session.add(song)
            self.session.commit()
        except Exception as e:
            self.session.rollback()
            raise
        return data["url"]

    def insert_artist(self,data):
        artist_name = data.get("artist_name", "")
        if not artist_name: raise BaseException("empty artist!")
        if artist_name in self.artists: return True
        data["letter"] = artist_name.upper()[0]
        if not re.findall("[А-Я]", data["letter"]) and not re.findall("[A-Z]", data["letter"]): data["letter"] = "0-9"
        data["url"] = self._translit(artist_name.lower())
        artist = self._fill_object(Artist(), data)
        try:
            self.session.add(artist)
            self.session.commit()
            self.artists.append(artist_name)
        except IntegrityError as e:
            self.session.rollback()
        except Exception as e:
            self.session.rollback()
            raise
        return True