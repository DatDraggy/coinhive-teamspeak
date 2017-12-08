# Coinhive Monero Miner TeamSpeak3 Integration

Let your TeamSpeak users mine Monero for you with one quick registration without having to download anything.

Users will receive a special TeamSpeak group upon reaching a customisable amount of hashes.

Finding security related bugs will be rewarded in ZenCash.

## Dependencies

What you need to use this project:
1. Webserver + PHP + MySQL Server
2. TeamSpeak3 Server
3. [coinhive.com](https://coinhive.com) Account
4. Domain (optional)

## How to use
1. Put all files on your webserver
2. Import coinhive_teamspeak.sql into your mysql server. You can use PHPMyAdmin or the terminal

   `mysql -u username -p coinhive_teamspeak < /path/to/file/coinhive_teamspeak.sql`

3. Go to [coinhive.com](https://coinhive.com) and create an account.
4. After loging in, click "settings" in the top right corner.
5. Select "Sites & API Keys"
6. Create a new site and copy your Secret Key (private) to config.php
7. Copy Site Key to miner.html on line 113
8. Fill out the rest of config.php

If you setup everything correctly you should be able to register and start mining by visiting miner.html on your domain.


#### Support
I will try to assist you as good as I can in the issues tab if you need any help.


#### Donations
```
BTC 122WSgrn2YVG6KQSKB53jfCaZYi3xMi6nb
ETH 0x4b39187EBBb674Fb659A81a433D8e8AfbE3aA32b
XMR 4916AsgEtXb68jck6PSYabbdLrpZUKTwQaA7Wm9tNKkAJwizHysjNK1ek989QX3hmtF1GHd1sUdn9G8bEBFNiWpw5pm4ToF
```

## Version History

### v1.0.1
- [x] added debug for better troubleshooting
- [x] changed default bot name

### v1.0.0
- [x] Release

#### Legal notice

MIT License

Copyright (c) 2017 DatDraggy

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
