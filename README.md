# workerman-ntp

NTP server powered by workerman

Powered by [Workerman](https://github.com/walkor/workerman) and [NTPLite](https://github.com/majetzx/ntplite)

# Install
## Debian 11
```bash
apt install php7.4-cli composer git
git clone https://github.com/wwng2333/workerman-ntp.git
cd generate_204
composer install
php ntp.php start -d
```
## Alpine Linux 3.18
```bash
apk add git composer php81-cli php81-posix php81-pcntl
git clone https://github.com/wwng2333/workerman-ntp.git
cd generate_204
composer install
php ntp.php start -d
```
# Test
```
root@crazy:~/crazy-ntp# php ntp.php start
Workerman[ntp.php] start in DEBUG mode
------------------------------------------------- WORKERMAN -------------------------------------------------
Workerman version:4.1.6          PHP version:7.4.3-4ubuntu2.17           Event-Loop:\Workerman\Events\Select
-------------------------------------------------- WORKERS --------------------------------------------------
proto   user            worker              listen                    processes    status           
tcp     root            globalDataServer    frame://127.0.0.1:2207    1             [OK]            
udp     root            NTP Service         udp://0.0.0.0:123         1             [OK]            
-------------------------------------------------------------------------------------------------------------
Press Ctrl+C to stop. Start success.
Worker started!
Timer added!
recv:    
db 00 05 e9 00 00 02 40     00 08 f8 57 00 00 00 00     
e7 a8 75 e1 73 c8 24 c7     00 00 00 00 00 00 00 00     
00 00 00 00 00 00 00 00     e7 a8 95 cc eb d8 a1 ed 
send:    
1c 03 05 ec 00 00 00 00     00 00 00 00 ca 26 40 07     
e7 a8 95 cc a2 4d d0 00     e7 a8 95 cc eb d8 a1 ed     
e7 a8 95 cc a2 0c 48 00     e7 a8 95 cc a2 4d d0 00 

```
# License
LGPL 2.1 , according to NTPLite.
