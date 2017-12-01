# Coinhive Monero Miner TeamSpeak3 Integration

Let your TeamSpeak users mine Monero for you with one quick registration without having to download anything.

Users will receive a special TeamSpeak group upon reaching a customisable amount of hashes.

## Dependencies

What you need to use this project:
1. Webserver + PHP + MySQL Server
2. TeamSpeak3 Server
3. [coinhive.com](https://coinhive.com) Account
4. Domain (optional)

## How to use
1. Put all files on your webserver
2. Import coinhive_teamspeak.sql into your mysql server. You can use PHPMyAdmin or using the terminal

   `mysql -u username -p coinhive_teamspeak < /path/to/file/coinhive_teamspeak.sql`

1. Go to [coinhive.com](https://coinhive.com) and create an account.
2. After loging in, click "settings" in the top right corner.
3. Select "Sites & API Keys"
4. Create a new site and copy your Secret Key (private) to config.php
5. Copy Site Key to miner.html on line 113
6. Now fill out the rest of config.php

If you setup everything correctly you should be able to register and start mining.


#### Support
I will try to assist you as good as I can in the issues tab if you need any help.


Donations
```
BTC 122WSgrn2YVG6KQSKB53jfCaZYi3xMi6nb
ETH 0x4b39187EBBb674Fb659A81a433D8e8AfbE3aA32b
XMR 4916AsgEtXb68jck6PSYabbdLrpZUKTwQaA7Wm9tNKkAJwizHysjNK1ek989QX3hmtF1GHd1sUdn9G8bEBFNiWpw5pm4ToF
```
