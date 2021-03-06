#!/usr/bin/python
# -*- coding: utf8 -*-

import time, os
import datetime
import traceback

logs_prefix = '$BASE_PATH/logs/'

def capim_mtime():
    return time.ctime(os.path.getmtime('capim.py'))

import capim
last_mtime = capim_mtime()

def dispatch(environ, start_response):
    global last_mtime
    new_mtime = capim_mtime()
    if last_mtime != new_mtime:
        reload(capim)
        last_mtime = new_mtime
    try:
        return capim.run(environ, start_response)
    except:
        now = datetime.datetime.now()
        fp = open(logs_prefix + str(now.year) + '_' + str(now.month) + '_' + str(now.day) + '.log', 'a')
        fp.write('============================================================\n')
        fp.write(str(now))
        fp.write('\n')
        fp.write(str(environ))
        fp.write('\n')
        traceback.print_exc(file=fp)
        fp.close()
        start_response('404 Not Found', [('Content-Type', 'text/html; charset=UTF-8')])
        return ['<html><head><title>404</title></head><body><center>404 - Arquivo não encontrado</center></body></html>']

if __name__ == '__main__':
    ext = __file__.split('.')[-1]
    if ext == 'fcgi':
        from flup.server.fcgi_fork import WSGIServer
        WSGIServer(dispatch).run()
    else:
        from wsgiref.handlers import CGIHandler
        CGIHandler().run(dispatch)
