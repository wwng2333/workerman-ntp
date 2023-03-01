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
## Start on server:
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

## chrony

```
[root@crazy ~]# chronyc sources -v

  .-- Source mode  '^' = server, '=' = peer, '#' = local clock.
 / .- Source state '*' = current best, '+' = combined, '-' = not combined,
| /             'x' = may be in error, '~' = too variable, '?' = unusable.
||                                                 .- xxxx [ yyyy ] +/- zzzz
||      Reachability register (octal) -.           |  xxxx = adjusted offset,
||      Log2(Polling interval) --.      |          |  yyyy = measured offset,
||                                \     |          |  zzzz = estimated error.
||                                 |    |           \
MS Name/IP address         Stratum Poll Reach LastRx Last sample               
===============================================================================
^* crazy.ntp.do>                 3   6    17    59  +1022us[+1191us] +/- 6549us
^? hkhkg1-ntp-004.aaplimg.c>     1   6     3     2   -464us[ -464us] +/-   21ms
^? 106.55.184.199                2   6     3     2   -532us[ -532us] +/-   50ms

```

## Busybox NTP Client
```
Mar  1 11:28:25 NTP Client: Synchronizing time to crazy.ntp.lan.
Mar  1 11:28:26 NTP Client: System time changed, offset: 0.228898s
```

## Windows
![image](https://user-images.githubusercontent.com/17147265/222060792-91677123-4049-4dcb-9b05-1536dbfdc5f5.png)

# License
LGPL 2.1 , according to NTPLite.
